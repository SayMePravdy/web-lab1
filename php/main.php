<?php
    session_start();

    $start_time = microtime(true);
    $x = $_GET["x"];
    $y = $_GET["y"];
    $r = $_GET["r"];


    $errorMsg = validate($x, $y, $r);
    $check = "Нет";
    if (checkPoint($x, $y, $r) && strcmp($errorMsg, '') == 0) {
        $check = "Да";
    }
    date_default_timezone_set('Europe/Moscow');
    $time = date('H:i:s');
    $exec_time = round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 6);

    $array = array('x' => $x, 'y' => $y, 'r' => $r, 'check' => $check, 'exec_time' => $exec_time, 'time' => $time);
    array_push($_SESSION['table'], $array);

    echo "{" .
        "\"x\":\"$x\"," .
        "\"y\":\"$y\"," .
        "\"r\":\"$r\"," .
        "\"time\":\"$time\"," .
        "\"exec_time\":\"$exec_time\"," .
        "\"check\":\"$check\"," .
        "\"err_msg\":\"$errorMsg\"" .
        "}";


    function validate($x, $y, $r) {
        $errorMsg = "";
        if ($x < -3 || $x > 5 || !is_numeric($x)) {
            $errorMsg .= "X должен быть целым и лежать в отрезке [-3;5]\n";
        }
        if ($y <= -5 || $y >= 5) {
            $errorMsg .= "Y должен лежать в интервале (-5;5)\n";
        }
        if ($r < 1 || $r > 5  || !is_numeric($r)) {
            $errorMsg .= "R должен быть целым и лежать в отрезке [1;5]\n";
        }
        return $errorMsg;
    }

    function checkPoint($x, $y, $r) {
        if ($x >= 0 && $y >= 0 && $y <= $r && $x <= $r/2) {
            return true;
        }
        if ($x <= 0 && $y >= 0 && ($x * $x + $y * $y <= ($r * $r))) {
            return true;
        }
        if ($x >= 0 && $y <= 0 && $y >= (2 * $x - $r)) {
            return true;
        }
        return false;
    }
    