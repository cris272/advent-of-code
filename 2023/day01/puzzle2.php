<?php
$input = fopen(__DIR__."/input", "r");

$numbers = [
    "one"   => 1,
    "two"   => 2,
    "three" => 3,
    "four"  => 4,
    "five"  => 5,
    "six"   => 6,
    "seven" => 7,
    "eight" => 8,
    "nine"  => 9,
];

$result = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");

    preg_match_all('#(?=(one|two|three|four|five|six|seven|eight|nine|[0-9]))#', $line, $m);
    $calibration = convertNumber($m[1][0]).convertNumber(end($m[1]));

    $result += $calibration;
}

echo "Solution : '$result'";


function convertNumber($number):int {
    global $numbers;
    if(is_numeric($number))
        return $number;
    
    return $numbers[$number];
}