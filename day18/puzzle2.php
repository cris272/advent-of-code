<?php

$grid = [];
$contact = 0;
$mx = $my = $mz = false;
$bound = [];
$input = array_map(function($line) use (&$grid, &$mx, &$my, &$mz){ 
    $coord = explode(',', trim($line));
    $grid[$coord[0]][$coord[1]][$coord[2]] = $coord;
    $mx = max($mx, $coord[0]);
    $my = max($my, $coord[1]);
    $mz = max($mz, $coord[2]);
    return $coord;

}, file(__DIR__."/input"));

$direction = [
    [1,0,0],
    [-1,0,0],
    [0,1,0],
    [0,-1,0],
    [0,0,1],
    [0,0,-1],
];

$start = current(current($grid[$mx]));
$bound[] = $start;

while(true){
    
}

var_dump($start);
die();

array_map(function($coord) use ($grid, &$contact) {
    if(isset($grid[$coord[0]+1][$coord[1]][$coord[2]]))
        $contact++;
    if(isset($grid[$coord[0]-1][$coord[1]][$coord[2]]))
        $contact++;
    if(isset($grid[$coord[0]][$coord[1]+1][$coord[2]]))
        $contact++;
    if(isset($grid[$coord[0]][$coord[1]-1][$coord[2]]))
        $contact++;
    if(isset($grid[$coord[0]][$coord[1]][$coord[2]+1]))
        $contact++;
    if(isset($grid[$coord[0]][$coord[1]][$coord[2]-1]))
        $contact++;
}, $input);

echo "\nSolution : ".count($input) * 6 - $contact;