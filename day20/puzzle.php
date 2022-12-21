<?php

$numbers = file(__DIR__."/input");
$new_numbers = $numbers;
$treated_indexes = [];
$solution = 0;
$count = count($numbers) - 1;
for($i = 0; $i<count($numbers) ; $i++){
    foreach ($numbers as $current_index => $value) {
        if(in_array($current_index, $treated_indexes))
            continue;
            
        $new_index = ($current_index+$value) % $count;
        if($new_index < 0)
            $new_index = ($count + $new_index);
            
        if($new_index == 0)
            $new_index = count($numbers) - 1;
        move_element($numbers, $current_index, $new_index);

        $new_treated_indexes = $treated_indexes;
        for($j = min($current_index, $new_index); $j <= max($current_index, $new_index);$j++){
            $index = array_search($j, $treated_indexes);
            if($index !== false){
                if($current_index - $new_index < 0)
                    $new_treated_indexes[$index]--;
                if($current_index - $new_index > 0)
                    $new_treated_indexes[$index]++;
            }
            
        }
        $new_treated_indexes[] = $new_index;
        $treated_indexes = $new_treated_indexes;
        break;
    }
}

function move_element(&$array, $current_index, $new_index) {
    $out = array_splice($array, $current_index, 1);
    array_splice($array, $new_index, 0, $out);
}

$init = true;
reset($numbers);
for($i = 1; $i <= 3000 ; $i++){
    if(current($numbers) == 0 && $init){
        $i=1;
        $init = false;
    }
    next($numbers);
    if(current($numbers) === false)
        reset($numbers);
    if($i % 1000 == 0){
        $solution += current($numbers);
    }
}

echo "\nSolution : ".$solution;