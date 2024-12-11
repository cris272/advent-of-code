<?php
$input = fopen(__DIR__."/input", "r");

$result = 0;
$left = $right = [];
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    preg_match('/^(\d*)\s*(\d*)$/', $line, $numbers);
    $left[] = $numbers[1];
    $right[] = $numbers[2];
}
sort($right);
sort($left);
foreach($left as $key => $value) {
    $result += abs($left[$key] - $right[$key]);
}

echo "Solution : '$result'";