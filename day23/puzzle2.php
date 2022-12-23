<?php
$solution = 0;
$min_x = $max_x = 0;
$map = array_map(fn($line) => str_split(trim($line)), file(__DIR__."/input"));
$max_x = count($map[0])-1;
$directions = ['N', 'S', 'W', 'E'];

$continue = true;
$step = 0;
while($continue){
    $continue = false;
    $step++;
    $new_map = [];
    foreach($map as $y => $line){
        foreach($line as $x => $char){
            if(isset($map[$y][$x]) && $map[$y][$x] == '#'){
                $available_directions = [];
                foreach ($directions as $direction) {
                    if(test(['y' => $y, 'x' => $x], $direction)){
                        $available_directions[] = $direction;
                    }
                }
            
                if(count($available_directions) == 4 || count($available_directions) == 0){
                    $new_map[$y][$x][] = ['y' => $y, 'x' => $x];
                }
                else{
                    $new_position = test(['y' => $y, 'x' => $x], $available_directions[0]);
                    $new_map[$new_position['y']][$new_position['x']][] = ['y' => $y, 'x' => $x];

                    $min_x = min($new_position['x'], $min_x);
                    $max_x = max($new_position['x'], $max_x);
                }
            }
        }
    }
    $map = [];
    foreach($new_map as $y => $line){
        foreach($line as $x => $old_coords){
            if(count($old_coords) == 1){
                $map[$y][$x] = '#';
                if($y != $old_coords[0]['y'] || $x != $old_coords[0]['x'])
                    $continue = true;
            }
            else{
                foreach($old_coords as $old_coord){
                    $map[$old_coord['y']][$old_coord['x']] = '#';
                }
            }
        }
    }
    ksort($map);
    $direction = array_shift($directions);
    $directions[] = $direction;
    
}
echo "\nSolution : ".$step;

function draw() :int{
    global $map;
    global $min_x;
    global $max_x;
    $solution = 0;
    
    for($y = array_key_first($map) ; $y <= array_key_last($map); $y++){
        echo str_pad($y, 2);
        for($x = $min_x;$x <= $max_x; $x++){
            if(!isset($map[$y][$x])){
                echo ".";
                $solution++;
            }
            else
                echo $map[$y][$x];
        }
        echo "\n";
    }
    echo "\n\n";
    return $solution;
}

function test($elve_position, $direction){
    global $map;

    switch($direction){
        case 'N':
            if(
                ( ($map[$elve_position['y'] - 1][$elve_position['x'] - 1] ?? '.') != '#' ) &&
                ( ($map[$elve_position['y'] - 1][$elve_position['x']] ?? '.') != '#' ) &&
                ( ($map[$elve_position['y'] - 1][$elve_position['x'] + 1] ?? '.') != '#' )
            )
                return ['y' => $elve_position['y'] - 1, 'x' => $elve_position['x']];
            break;
        case 'S':
                if(
                    ( ($map[$elve_position['y'] + 1][$elve_position['x'] - 1] ?? '.') != '#' ) &&
                    ( ($map[$elve_position['y'] + 1][$elve_position['x']] ?? '.') != '#' ) &&
                    ( ($map[$elve_position['y'] + 1][$elve_position['x'] + 1] ?? '.') != '#' )
                )
                    return ['y' => $elve_position['y'] + 1, 'x' => $elve_position['x']];
                break;

        case 'E':
            if(
                ( ($map[$elve_position['y'] - 1][$elve_position['x'] + 1] ?? '.') != '#' ) &&
                ( ($map[$elve_position['y']][$elve_position['x'] +1] ?? '.') != '#' ) &&
                ( ($map[$elve_position['y'] + 1][$elve_position['x'] + 1] ?? '.') != '#' )
            )
            return ['y' => $elve_position['y'], 'x' => $elve_position['x'] + 1];
            break;
        case 'W':
                if(
                    ( ($map[$elve_position['y'] - 1][$elve_position['x'] - 1] ?? '.') != '#' ) &&
                    ( ($map[$elve_position['y']][$elve_position['x'] - 1] ?? '.') != '#' ) &&
                    ( ($map[$elve_position['y'] + 1][$elve_position['x'] - 1] ?? '.') != '#' )
                )
                    return ['y' => $elve_position['y'], 'x' => $elve_position['x'] - 1];
                break;
    }
    return false;
}