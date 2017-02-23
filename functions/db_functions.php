<?php

use PTA\Models\Notification;
use PTA\Models\Route;
use PTA\Models\RouteStop;
use PTA\Models\Stop;
use PTA\Models\TripStop;
use PTA\Models\VehicleTrip;

require 'db_connect.php';

/**
 * Get all stops of a certain route that a certain vehicle is currently taking.
 * @param int $vehicleId The vehicle to get the current stops from.
 * @return TripStop[] The array of trip stops.
 * @throws Exception If an SQL exception occurred.
 */
function getTripStops($vehicleId)
{
    global $mysqli;

    if ($stmt = $mysqli->prepare('SELECT rs.sequence, r.name, s.name, s.place, ts.arrived_on, ts.id FROM vehicle v
	INNER JOIN vehicle_trip vt ON v.id = vt.vehicle_id
    INNER JOIN route r ON vt.route_id = r.id
    INNER JOIN route_stop rs ON r.id = rs.route_id
    INNER JOIN stop s ON rs.stop_id = s.id
    INNER JOIN trip_stop ts ON rs.id = ts.route_stop_id AND vt.id = ts.vehicle_trip_id
    INNER JOIN (SELECT id, MAX(started_on) FROM vehicle_trip WHERE vehicle_id = ? GROUP BY id) vt_max
WHERE v.id = ? AND vt.id = vt_max.id
ORDER BY rs.sequence')
    ) {
        $stmt->bind_param('ii', $vehicleId, $vehicleId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($sequence, $routeName, $stopName, $stopPlace, $arrivedOn, $subscriptionId);

        $list = array();
        while ($stmt->fetch()) {
            $route = Route::create()
                ->setName($routeName);

            $list[] = TripStop::create()
                ->setArrivedOn($arrivedOn)
                ->setId($subscriptionId)
                ->setVehicleTrip(VehicleTrip::create()
                    ->setRoute($route))
                ->setRouteStop(RouteStop::create()
                    ->setRoute($route)
                    ->setSequence($sequence)
                    ->setStop(Stop::create()
                        ->setPlace($stopPlace)
                        ->setName($stopName)
                    ));
        }
        $stmt->close();
        return $list;
    } else {
        error_log("MySQL error($mysqli->errno) occurred: $mysqli->error");
        throw new Exception("MySQL error occurred: $mysqli->error", $mysqli->errno);
    }
}

function getTripStopById($id)
{
    global $mysqli;
    if ($stmt = $mysqli->prepare('SELECT ts.arrived_on FROM trip_stop ts WHERE ts.id = ?')) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($arrivedOn);
        if ($stmt->fetch() === null) {
            return null;
        }
        return TripStop::create()
            ->setId($id)
            ->setArrivedOn($arrivedOn);
    } else {
        error_log("MySQL error($mysqli->errno) occurred: $mysqli->error");
        throw new Exception("MySQL error occurred: $mysqli->error", $mysqli->errno);
    }
}

/**
 * Subscribe device to notification upon vehicle arriving at stop.
 * @param Notification $notification
 */
function subscribeToTripStop($notification)
{
    global $mysqli;

    if ($stmt = $mysqli->prepare('INSERT INTO notification (trip_stop_id, registration_id) VALUES (?, ?)')) {
        $stmt->bind_param('ss', $notification->getTripStop()->getId(), $notification->getRegistrationId());
        $stmt->execute();
    }
}
