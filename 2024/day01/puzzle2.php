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
$right = array_count_values($right);
foreach($left as $key => $value) {
    if(isset($right[$value]))
        $result += $right[$value] * $value;
}

echo "Solution : '$result'";