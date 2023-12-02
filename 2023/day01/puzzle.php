<?php
$input = fopen(__DIR__."/input", "r");

$result = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");

    preg_match_all('#[0-9]#', $line, $m);
    $calibration = $m[0][0].end($m[0]);

    $result += $calibration;
}

echo "Solution : '$result'";

