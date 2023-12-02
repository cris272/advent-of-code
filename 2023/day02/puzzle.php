<?php
$input = fopen(__DIR__."/input", "r");

$colors = [
    "red"   => 12,
    "green" => 13,
    "blue"  => 14,
];

$result = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    $possible = true;

    preg_match('#Game ([0-9]*):(.*)#', $line, $m);
    
    $game = $m[1];
    $sets = explode(';', $m[2]);
    foreach ($sets as $set) {
        foreach ($colors as $color => $max) {
            if(preg_match("#([0-9]*) $color#", $set, $m)){
                $nb = $m[1];
                if($nb > $max){
                    $possible = false;
                }
            }
        }
    }
    if($possible){
        $result += $game;
    }
}

echo "Solution : '$result'";

