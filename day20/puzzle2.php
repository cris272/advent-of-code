<?php

$numbers = array_map(fn($a, $b) => ['value' => $a * 811589153, 'original_index' => $b, 'index' => $b, 'treated' => false],file(__DIR__."/input"), array_keys(file(__DIR__."/input")));
$new_numbers = $numbers;
$solution = 0;
$count = count($numbers) - 1;
for($k = 0; $k<10;$k++){
    echo ".";
    for($i = 0; $i<count($numbers) ; $i++){
        foreach ($numbers as $original_index => $number) {
            $current_index = $number['index'];
            if($number['treated'])
                continue;
        
            $new_index = ($current_index+$number['value']) % $count;
            if($new_index < 0)
                $new_index = ($count + $new_index);
                
            if($new_index == 0)
                $new_index = count($numbers) - 1;
            move_element($new_numbers, $current_index, $new_index);

            for($j = min($current_index, $new_index); $j <= max($current_index, $new_index);$j++){
                $new_numbers[$j]['index'] = $j;
                $numbers[$new_numbers[$j]['original_index']]['index'] = $j;               
            }

            $new_numbers[$new_index]['index'] = $new_index;
            $numbers[$original_index]['index'] = $new_index;
            $numbers[$original_index]['treated'] = true;
            break;
        }
    }
    $numbers = array_map(function ($a){ $a['treated'] = false; return $a;},$numbers);
}

function move_element(&$array, $current_index, $new_index) {
    $out = array_splice($array, $current_index, 1);
    array_splice($array, $new_index, 0, $out);
}

$init = true;
reset($new_numbers);
for($i = 1; $i <= 3000 ; $i++){
    if(current($new_numbers)['value'] == 0 && $init){
        $i=1;
        $init = false;
    }
    next($new_numbers);
    if(current($new_numbers) === false)
        reset($new_numbers);
    if($i % 1000 == 0){
        $solution += current($new_numbers)['value'];
    }
}

echo "\nSolution : ".$solution;