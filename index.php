<?php

use PTA\Models\Notification;

header('Content-Type: application/json');

require __DIR__ . '/functions/functions.php';
require __DIR__ . '/functions/autoload.php';

$action = getVariable('action');

switch ($action) {
    case 'get_stops':
        require __DIR__ . '/functions/db_functions.php';

        if (!checkVariableExistence(array('vehicleId'))) {
            stop(404, json_encode(array(
                'error' => array(
                    'code' => '404',
                    'message' => 'Parameter \'vehicleId\' missing.',
                )
            )));
        }

        $vehicleId = getVariable('vehicleId');

        $tripStops = getTripStops($vehicleId);

        $data = array();

        foreach ($tripStops as $tripStop) {
            $data[] = array(
                'arrived_on' => $tripStop->getArrivedOn(),
                'sequence' => $tripStop->getRouteStop()->getSequence(),
                'subscriptionId' => $tripStop->getId(),
                'stopName' => $tripStop->getRouteStop()->getStop()->getName(),
                'stopPlace' => $tripStop->getRouteStop()->getStop()->getPlace(),
                'routeName' => $tripStop->getRouteStop()->getRoute()->getName(),
            );
        }

        stop(200, json_encode(array(
            'data' => array(
                'stops' => $data,
            )
        )));

        break;
    case 'subscribe':
        require __DIR__ . '/functions/db_functions.php';

        if (!checkVariableExistence(array('subscriptionId', 'notificationRegistrationId'))) {
            stop(404, json_encode(array(
                'error' => array(
                    'code' => '404',
                    'message' => "Required parameters: 'subscriptionId' and 'notificationRegistrationId'",
                )
            )));
        }

        $tripStopId = getVariable('subscriptionId');
        $notificationRegistrationId = getVariable('notificationRegistrationId');

        try {
            $tripStop = getTripStopById($tripStopId);
        } catch (Exception $ex) {
            $tripStop = null;
            stop(500, json_encode(array(
                'error' => array(
                    'code' => '500',
                    'message' => 'Server error. If this error persists, please contact info@sd4u.be.',
                )
            )));
        }

        if ($tripStop === null) {
            stop(403, json_encode(array(
                'error' => array(
                    'code' => '403',
                    'message' => 'Trip stop not found.',
                )
            )));
        }

        try {
            $tripStop = getTripStopById($tripStopId);
        } catch (Exception $ex) {
            $tripStop = null;
            serverErrorOccurred();
        }

        try {
            subscribeToTripStop(Notification::create()
                ->setRegistrationId($notificationRegistrationId)
                ->setTripStop($tripStop));
            stop(200, json_encode(array(
                'data' => array(
                    'message' => 'Device successfully subscribed to notify event.',
                )
            )));
        } catch (Exception $ex) {
            serverErrorOccurred();
        }

        break;
    default:
        stop(404, json_encode(array(
            'error' => array(
                'code' => '404',
                'message' => "Parameter 'action' missing.",
            )
        )));
}
