<?php
$input = fopen(__DIR__."/input", "r");

$colors = [
    "red"   => 1,
    "green" => 1,
    "blue"  => 1,
];

$result = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    $possible = true;
    $colorsMax = $colors;

    preg_match('#Game ([0-9]*):(.*)#', $line, $m);
    
    $game = $m[1];
    $sets = explode(';', $m[2]);
    foreach ($sets as $set) {
        foreach ($colorsMax as $color => $max) {
            if(preg_match("#([0-9]*) $color#", $set, $m)){
                $nb = $m[1];
                if($nb > $max){
                    $colorsMax[$color] = $nb;
                }
            }
        }
    }

    $power = 1;
    foreach($colorsMax as $value){
        $power *= $value;
    }
    $result += $power;
}

echo "Solution : '$result'";

