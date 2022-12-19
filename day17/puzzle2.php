<?php

$rocks = [
    0 => [
        ['1', '1', '1', '1']
    ],
    1 => [
        ['.', '2', '.'],
        ['2', '2', '2'],
        ['.', '2', '.'],
    ],
    2 => [
        ['.', '.', '3'],
        ['.', '.', '3'],
        ['3', '3', '3'],
    ],
    3 => [
        ['4'],
        ['4'],
        ['4'],
        ['4'],
    ],
    4 => [
        ['5', '5'],
        ['5', '5'],
    ],
];

$solution = 0;
$gas = str_split(trim(file_get_contents(__DIR__."/input")));
$map = [];
$max_y = 0;
for($i = 0 ; $i< 2022 ; $i++){
    $current_rock = current($rocks) ? current($rocks):reset($rocks);
    next($rocks);
    $fall = true;
    $current_rock_position = ['x' => 2, 'y' => count($map) + 3];
    while($fall){
        $g = current($gas) ? current($gas):reset($gas);
        next($gas);
        $new_current_rock_position = $current_rock_position;
        $new_current_rock_position['x'] = ($g == '>') ? $new_current_rock_position['x']+1:$new_current_rock_position['x']-1;
  
        if(test_position($current_rock, $new_current_rock_position, $map))
            $current_rock_position = $new_current_rock_position;


        $new_current_rock_position = $current_rock_position;
        $new_current_rock_position['y']--;

        if(test_position($current_rock, $new_current_rock_position, $map)){
            $current_rock_position = $new_current_rock_position;
        }
        else{
            update_map($current_rock, $current_rock_position, $map);
            $fall = false;
            // draw();
            // print_r($map);
            // readline();
        }
    }
}
// draw();
echo "\nSolution : ".$max_y;

function test_position(array $current_rock, array $new_current_rock_position, array $map) :bool {
    // var_dump($new_current_rock_position);
    if($new_current_rock_position['x'] == -1 || $new_current_rock_position['x']+count($current_rock[0]) == 8 || $new_current_rock_position['y'] == -1)
        return false;

    $current_rock = array_reverse($current_rock);
    foreach (($current_rock) as $y => $line) {
        foreach ($line as $x => $char) {
            if($char != '.' && (isset($map[$new_current_rock_position['y'] + $y][$new_current_rock_position['x'] + $x]) && $map[$new_current_rock_position['y'] + $y][$new_current_rock_position['x'] + $x] != '.'))
                return false;
        }
    }
    return true;
}

function update_map(array $current_rock, array $current_rock_position, array &$map) :void {
    global $solution;
    global $max_y;
    $current_rock = array_reverse($current_rock);
    $i = 0;
    foreach (($current_rock) as $y => $line) {
        foreach ($line as $x => $char) {
            if($char != '.') {
                $map[$current_rock_position['y'] + $y][$current_rock_position['x'] + $x] = $current_rock[$y][$x];
                if($current_rock_position['y'] + $y > $max_y)
                    $max_y = $current_rock_position['y'] + $y;
            }
        }
    }

    if(count($map) >= 10){
        print_r($map);
        $solution += count($map) - 10;
        $map = array_slice($map, -10, null, true);
    }
}

function draw() :void{
    global $map;
    $m = array_reverse($map);

    foreach ($m as $y => $line) {
        echo str_pad($y, 3)."|";
        for($i = 0;$i <7;$i++){
            echo $m[$y][$i] ?? '.';
        }
        echo "|";
        echo "\n";
        // if($y > 99)
            // break;

    }
    echo "\n";
    echo "\n";
    echo "\n";
    echo "\n";
}


