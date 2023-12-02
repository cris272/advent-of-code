<?php

$grid = [];
$contact = 0;
$input = array_map(function($line) use (&$grid, &$contact){ 
    $coord = explode(',', trim($line));
    $grid[$coord[0]][$coord[1]][$coord[2]] = 1;
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
}, file(__DIR__."/input"));

echo "\nSolution : ".count($input) * 6 - $contact * 2;