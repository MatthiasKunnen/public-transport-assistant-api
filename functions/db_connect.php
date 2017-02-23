<?php
require dirname(__DIR__) . '/config/db_config.php';

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->connect_errno) {
    error_log("Failed to connect to MySQL: ($mysqli->connect_errno) $mysqli->connect_error");
    throw new Exception("Failed to connect to MySQL: $mysqli->connect_error", $mysqli->connect_errno);
}
$mysqli->set_charset("utf8");
