<?php
$input = fopen(__DIR__."/input", "r");

$result = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    $levels = explode(' ', $line);

    if(valid($levels)) {
        $result ++;
    }
}

echo "Solution : '$result'";


function valid($levels) {
    $direction = null;
    foreach ($levels as $key => $level) {
        if($key == 0) {
            continue;
        }
        $prev = $levels[$key - 1];
        $diff = $level - $prev;
        if(abs($diff) > 3 || $diff === 0){
            return false;
        }
        if($direction === null) {
            if($diff > 0) {
                $direction = "up";
            } else {
                $direction = "down";
            }
        }
        if($diff > 0 && $direction == "down") {
            return false;
        }
        elseif($diff < 0 && $direction == "up") {
            return false;
        }
    }
    return true;
}