<?php
    $start_time = microtime(true);
    $x = $_GET["x"];
    $y = $_GET["y"];
    $r = $_GET["r"];


    $errorMsg = validate($x, $y, $r);

    var_dump($errorMsg);

    if (strcmp($errorMsg, "") === 0) {
        var_dump("aboba");
    }

    $check = "Нет";

    if (checkPoint($x, $y, $r)) {
        $check = "Да";
    }

    $time = date('H:i:s');
    $exec_time = microtime(true) - $start_time;

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
            $errorMsg += "X должен быть целым и лежать в отрезке [-3;5]\n";
        }
        if ($y <= -5 || $y >= 5) {
            $errorMsg += "Y должен лежать в интервале (-5;5)\n";
        }
        if ($r < 1 || $r > 5  || !is_numeric($r)) {
            $errorMsg += "X должен быть целым и лежать в отрезке [1;5]\n";
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
    