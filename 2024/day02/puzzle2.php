<?php
$input = fopen(__DIR__."/input", "r");

$result = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    $levels = explode(' ', $line);

    echo  "\n";
    echo $line . "\n";

    $new_level = $levels;
    foreach ($levels as $key => $level) {
        $new_level = $levels;
        unset($new_level[$key]);
        $new_level = array_values($new_level);

        $valid = valid($new_level);
        if($valid) {
            echo "valid\n";
            $result ++;
            break;
        }
    }

    if(!$valid) {
        echo "not valid\n";
    }
}
echo "Solution : '$result'";


function valid($levels, $allowError = true) {
    $direction = null;
    $error = false;
    foreach ($levels as $key => $level) {
        if($key == 0) {
            continue;
        }
        $prev = $levels[$key - 1];
        $diff = $level - $prev;

        // echo $diff . "\n";
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




