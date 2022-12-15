<?php

$map = [];
$solution = $max_x = $max_y = $min_x = 0;
$sensors = [];
$input = array_map(function($line) use (&$map, &$min_x, &$max_x, &$sensors){ 
    preg_match('#Sensor at x=([\-0-9]*), y=([\-0-9]*): closest beacon is at x=([\-0-9]*), y=([\-0-9]*)#', trim($line), $m);

    $sensors[] = [
        'x' => $m[1],
        'y' => $m[2],
        'distance' => abs($m[1]-$m[3]) + abs($m[2]-$m[4])
    ];
    $map[$m[1]][$m[2]] = 'S';
    $map[$m[3]][$m[4]] = 'B';
    $distance = abs($m[1]-$m[3]) + abs($m[2]-$m[4])+1;

    $min_x = $m[1]-$distance < $min_x ? $m[1]-$distance:$min_x;
    $max_x = $m[1]+$distance > $max_x ? $m[1]+$distance:$max_x;
}, file(__DIR__."/input"));


foreach ($map as $x => $value) {
    if(isset($value['10']) && $value['10'] == '#')
        $solution++;
}

$y = 2000000;
for($x = $min_x;$x <= $max_x; $x++){
    $coord = ['x' => $x, 'y' => $y];
    foreach ($sensors as $key => $sensor) {
        if(
            ($x > $sensor['x'] + $sensor['distance']) ||
            ($x < $sensor['x'] - $sensor['distance']) ||
            ($y < $sensor['y'] - $sensor['distance']) ||
            ($y > $sensor['y'] + $sensor['distance']) ||
            (isset($map[$x][$y]))
        )
            continue;
        else{
            if(collision($sensor, $coord)){
                $solution++;
                break;
            }
        }
    }
}
echo "\n";


function collision($sensor, $coord){
    $A = [
        'x' => $sensor['x'] - $sensor['distance'],
        'y' => $sensor['y']
    ];
    $B = [
        'x' => $sensor['x'] + $sensor['distance'],
        'y' => $sensor['y']
    ];
    $C = [
        'x' => $sensor['x'],
        'y' => $sensor['y'] + $sensor['distance']
    ];
    if($coord['y'] < $sensor['y'])
        $C['y'] = $sensor['y'] - $sensor['distance'];
    
    $area_orig = area($A,$B,$C);
    if($area_orig == (area($A,$B,$coord) + area($A,$coord,$C) + area($coord,$B,$C)))
        return true;
    return false;
}

function area($A,$B,$C){
    return abs( ($B['x']-$A['x'])*($C['y']-$A['y']) - ($C['x']-$A['x'])*($B['y']-$A['y']) );
}

echo "\nSolution : $solution";

