<?php

$map = [];
$max_x = $max_y = 0;
$input = array_map(function($line) use (&$map, &$max_y){ 
    $points = explode(' -> ', trim($line));
    $start_x = $start_y = false;
    foreach ($points as $key => $point) {
        list($x, $y) = explode(',', $point);
        $max_y = ($y > $max_y) ? $y:$max_y;
        if(!$start_x){
            $start_x = $x;
            $start_y = $y;
        }
        else{
            $axe = $start_x == $x ? 'y':'x';
            $i = ${'start_'.$axe};
            for($j = 0; $j <= abs($$axe-${'start_'.$axe}); $j++){
                if($axe == 'y')
                    $map[$x][$i] = '#';
                else
                    $map[$i][$y] = '#';
                $i = ${'start_'.$axe} < $$axe ? $i+1:$i-1;
            }
            $start_x = $x;
            $start_y = $y;
        }
    }
}, file(__DIR__."/input"));

$solution = 0;
$floor = $max_y+2;
$sand_start = ['x' => 500, 'y' => 0];
while(true){
    $position_to_check = $sand_start;
    $last_available_position = false;
    while(true){
        if(!check($position_to_check)){
            if($position_to_check == $sand_start)
                break 2;
            $position_to_check['x']--;
            if(!check($position_to_check)){
                $position_to_check['x'] += 2;
                if(!check($position_to_check)){
                    $map[$last_available_position['x']][$last_available_position['y']] = 'O';
                    $solution++;
                    break;
                }
            }
        }

        if($position_to_check['y'] == $floor){
            $map[$last_available_position['x']][$last_available_position['y']] = 'O';
            $solution++;
            break;
        }

        $last_available_position = $position_to_check;
        $position_to_check['y']++;
    }
}

for($y = 0;$y <= $floor; $y++){
    for($x = 450;$x <= max(array_keys($map)); $x++){
        echo $map[$x][$y] ?? '.';
    }
    echo "\n";
}

echo "\nSolution : $solution";

function check($position_to_check){
    global $map;
    if(isset($map[$position_to_check['x']][$position_to_check['y']]) && in_array($map[$position_to_check['x']][$position_to_check['y']], ['#', 'O']))
        return false;
    return true;
}
