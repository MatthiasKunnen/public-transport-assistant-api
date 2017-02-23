<?php

/**
 * Sets the HTTP response code in the header.
 * @param int $code The HTTP response code to set.
 */
function setHttpResponseCode($code = 200)
{
    $phpApiName = substr(php_sapi_name(), 0, 3);
    if ($phpApiName === 'cgi' || $phpApiName === 'fpm') {
        header("Status: $code");
    } else {
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
        header("$protocol $code");
    }
}

/**
 * Stops the program after echoing $output and setting the HTTP response code.
 * @param int $httpResponseCode The HTTP response code to set.
 * @param string $output The output to echo.
 */
function stop($httpResponseCode = 200, $output = null)
{
    setHttpResponseCode($httpResponseCode);
    echo $output;
    exit();
}

/**
 * Get a variable by name from either POST or GET.
 * @param string $variable The name of the variable to search for.
 * @return mixed The variable or null if the variable was not found.
 */
function getVariable($variable)
{
    return isset($_POST[$variable]) ? $_POST[$variable] : (isset($_GET[$variable]) ? $_GET[$variable] : null);
}

/**
 * Checks whether the variables are retrievable by getVariable().
 * @param array|string $variables The variable(s) to check.
 * @see getVariable()
 * @return bool True if the variable(s) can be retrieved with getVariable().
 */
function checkVariableExistence($variables)
{
    if (!is_array($variables)) {
        return getVariable($variables) !== null;
    }

    foreach ($variables as $variable) {
        if (getVariable($variable) === null) {
            return false;
        }
    }

    return true;
}

/**
 * Dies with a HTTP 500 and JSON error message.
 */
function serverErrorOccurred()
{
    stop(500, json_encode(array(
        'error' => array(
            'code' => '500',
            'message' => 'Server error. If this error persists, please contact info@sd4u.be.',
        )
    )));
}
