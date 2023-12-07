<?php
$input = fopen(__DIR__."/input", "r");
preg_match_all('#(\d+)#', trim(str_replace(' ', '', fgets($input)), "\n"), $times);
preg_match_all('#(\d+)#', trim(str_replace(' ', '', fgets($input)), "\n"), $distances);

$result = 1;

foreach ($times[0] as $key => $time) {
    $max_distance = $distances[0][$key];
    $way_to_win = 0;
    for($i = 0; $i<= $time;$i++){
        $distance = calculDistance($i, $time);
        if($distance > $max_distance){
            $way_to_win++;
        }
    }

    $result *= $way_to_win;
}

echo "Solution : '$result'";

function calculDistance($holdTime, $totalTime) {
    return $holdTime*($totalTime-$holdTime);
}
