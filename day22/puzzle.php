<?php
$max_x = 0;
$map = array_map(function($line) use (&$max_x){
    $line = trim($line,"\n");
    if($max_x < strlen($line) && preg_match('#\.#', $line))
        $max_x = strlen(trim($line,"\n"))-1;

    return array_filter(str_split($line), fn($char) => $char != ' ');
}, file(__DIR__."/input"));
$operations = implode($map[count($map) - 1]);
unset($map[count($map) - 1]);
unset($map[count($map) - 1]);

preg_match_all('#[0-9]+[LR]?#', $operations, $m);
$operations = [];
foreach($m[0] as $match){
    preg_match('#([0-9]+)([LR])?#', $match, $m2);
    $operations[] = $m2[1];
    if(isset($m2[2]))
        $operations[] = $m2[2];
}

$directions = [
    'right' => [ 'x' => 1, 'y' => 0, 'score' => 0],
    'down' => [ 'x' => 0, 'y' => 1, 'score' => 1],
    'left' => [ 'x' => -1, 'y' => 0, 'score' => 2],
    'up' => [ 'x' => 0, 'y' => -1, 'score' => 3],
];
$new_current_position = $current_position = [
    'x' => key(current($map)),
    'y' => key($map),
];
$max_y = count($map)-1;

foreach ($operations as $operation) {
    if(is_numeric($operation)){
        $new_current_position = $current_position;
        for($i = 0;$i < $operation ; $i++){
            $continue = true;
            while($continue){
                $new_current_position = [
                    'x' => $new_current_position['x']+current($directions)['x'],
                    'y' => $new_current_position['y']+current($directions)['y'],
                ];

                if($new_current_position['x'] > $max_x)
                    $new_current_position['x'] = 0;
                elseif($new_current_position['x'] < 0)
                    $new_current_position['x'] = $max_x;

                if($new_current_position['y'] > $max_y)
                    $new_current_position['y'] = 0;
                elseif($new_current_position['y'] < 0)
                    $new_current_position['y'] = $max_y;

                if(isset($map[$new_current_position['y']][$new_current_position['x']])){
                    $continue = false;
                    if($map[$new_current_position['y']][$new_current_position['x']] == '.')
                        $current_position = $new_current_position;

                    if($map[$new_current_position['y']][$new_current_position['x']] == '#')
                        break 2;
                }
            }
        }
    }
    else{
        if($operation == 'R'){
            next($directions);
            if(current($directions) === false)
                reset($directions);
        }
        elseif($operation == 'L'){
            prev($directions);
            if(current($directions) === false)
                end($directions);
        }
    }
}
$solution = (1000 * ($current_position['y'] + 1)) + (4 * ($current_position['x'] + 1)) + current($directions)['score'];

echo "\nSolution : ".$solution;

function draw() :void{
    global $map;
    global $max_x;
    global $max_y;
    global $current_position;

    $map_draw = $map;
    $map_draw[$current_position['y']][$current_position['x']] = 'O';
    for($y = 0;$y <= $max_y; $y++){
        for($x = 0;$x <= $max_x; $x++){
            if(!isset($map_draw[$y][$x]))
                echo "|";
            else
                echo $map_draw[$y][$x];
        }
        echo "\n";
    }
    echo "\n\n";
}