<?php

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
            );
        }

        stop(200, json_encode(array(
            'data' => array(
                'stops' => $data,
            )
        )));

        break;
    default:
        stop(404, json_encode(array(
            'error' => array(
                'code' => '404',
                'message' => "Parameter 'action' missing.",
            )
        )));
}
