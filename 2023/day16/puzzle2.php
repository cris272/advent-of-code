<?php
$lines = file('input', FILE_IGNORE_NEW_LINES);

$vector = [
    'right' => ['x' => 1, 'y' => 0],
    'left'  => ['x' => -1, 'y' => 0],
    'up'    => ['x' => 0, 'y' => -1],
    'down'  => ['x' => 0, 'y' => 1],
];

$map = [];
foreach ($lines as $key => $line) {
    $map[] = str_split($line);
}

$possible_starts = [];
foreach($map as $y => $row) {
    $possible_starts[] = ['x' => 0, 'y' => $y, 'direction' => 'right'];
    $possible_starts[] = ['x' => count($row)-1, 'y' => $y, 'direction' => 'left'];
}
foreach($map[0] as $x => $char) {
    $possible_starts[] = ['x' => $x, 'y' => 0, 'direction' => 'down'];
    $possible_starts[] = ['x' => $x, 'y' => count($map)-1, 'direction' => 'up'];
}

$result = 0;
foreach($possible_starts as $possible_starts) {


    $beams = [
        $possible_starts
    ];
    
    $energized = [];

    while(count($beams) > 0) {
        foreach ($beams as $key => &$beam) {
            if(isset($energized[$beam['y']][$beam['x']]) && in_array($beam['direction'], $energized[$beam['y']][$beam['x']]['directions'])) {
                unset($beams[$key]);
                continue;
            }
            if(isset($map[$beam['y']][$beam['x']])) {
                $current_item = $map[$beam['y']][$beam['x']];
                $energized[$beam['y']][$beam['x']]['directions'][] = $beam['direction'];
            }
            else{
                unset($beams[$key]);
                continue;
            }

            $current_item = $map[$beam['y']][$beam['x']];

            if(in_array($current_item, ['/', '\\'])){
                $beam['direction'] = new_direction($beam['direction'], $current_item);
                
            }
            elseif(in_array($current_item, ['-', '|'])){
                $new_beams = new_beam($beam['direction'], $current_item, $beam);

                if($new_beams){
                    unset($beams[$key]);
                    $beams = array_merge($beams, $new_beams);
                    continue;
                }
            }

            $beam['x'] = $beam['x'] + $vector[$beam['direction']]['x'];
            $beam['y'] = $beam['y'] + $vector[$beam['direction']]['y'];
        }
    }
    $tmp_result = display();
    $result = $tmp_result > $result ? $tmp_result:$result;
}

echo "Solution : '$result'";


function new_beam($current_direction, $current_item, $beam){
    if(
        (in_array($current_direction, ['left', 'right']) && $current_item == '-') || 
        (in_array($current_direction, ['up', 'down']) && $current_item == '|') 
    ) {
        return false;
    }
    elseif(in_array($current_direction, ['left', 'right']) && $current_item == '|'){
        return [
            ['x' => $beam['x'], 'y' => $beam['y'] - 1, 'direction' => 'up'],
            ['x' => $beam['x'], 'y' => $beam['y'] + 1, 'direction' => 'down'],
        ];
    }
    elseif(in_array($current_direction, ['down', 'up']) && $current_item == '-'){
        return [
            ['x' => $beam['x'] - 1, 'y' => $beam['y'], 'direction' => 'left'],
            ['x' => $beam['x'] + 1, 'y' => $beam['y'], 'direction' => 'right'],
        ];
    }
    else{
        die('ko2');
    }
}


function new_direction($current_direction, $current_item){
    if(
        ($current_direction == 'right' && $current_item == '/') || 
        ($current_direction == 'left' && $current_item == '\\')
    ) {
        return 'up';
    }
    elseif(
            ($current_direction == 'left' && $current_item == '/') || 
            ($current_direction == 'right' && $current_item == '\\')
    ) {
            return 'down';
    }
    elseif(
            ($current_direction == 'up' && $current_item == '/') || 
            ($current_direction == 'down' && $current_item == '\\')
    ) {
            return 'right';
    }
    elseif(
            ($current_direction == 'down' && $current_item == '/') || 
            ($current_direction == 'up' && $current_item == '\\')
    ) {
            return 'left';
    }
    else{
        die('ko');
    }
}

function display (){
    $result = 0;
    global $map, $energized;
    foreach ($map as $y => $row) {
        foreach ($row as $x => $char) {
            if(isset($energized[$y][$x])) {
                $result++;
            }
            else{
            }
        }
    }
    return $result;
}