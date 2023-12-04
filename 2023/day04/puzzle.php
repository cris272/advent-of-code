<?php
$input = fopen(__DIR__."/input", "r");

$result = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    preg_match('#Card [ 0-9]+: ([ 0-9]+) \| ([ 0-9]+)#', $line, $m);
    $winning_numbers = explode(' ', $m[1]);
    $numbers = explode(' ', $m[2]);
    $intersect = array_intersect($winning_numbers, $numbers);

    $points = 0;
    foreach($intersect as $n) {
        if($n == '')
            continue;

        $points = ($points == 0 ? 1:$points*2);
    }
    $result += $points;
}

echo "Solution : '$result'";

