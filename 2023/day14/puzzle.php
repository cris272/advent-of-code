<?php
$lines = file('input', FILE_IGNORE_NEW_LINES);

$map = [];
foreach ($lines as $key => $line) {
    if($key == 0){
        $map[] = array_fill(0, strlen($line), '#');
    }
    $map[] = str_split($line);
}

$result = 0;
$nb_row = count($map[0]);

for($x = 0; $x < count($map[0]); $x++) {
    $column = array_column($map, $x);

    $squares = [];
    $spheres = [];
    array_walk($column, function($item, $key) {
        global $squares,$spheres;
        
        if($item == '#'){
            $squares[] = $key;
        }
        elseif($item == 'O'){
            $spheres[] = $key;
        }

    });
    
    for($i = count($squares)-1; $i>=0;$i--){
        $spheres_below = 0;
        $y = $squares[$i];
        array_walk($spheres, function($item, $key) use ($y){
            global $spheres, $spheres_below;

            if($item > $y){
                $spheres_below++;
                unset($spheres[$key]);
            }
        });

        $minus = ($spheres_below > 1) ?((($spheres_below-1) * $spheres_below) / 2):0;
        $result += (($nb_row - $y) * $spheres_below) - $minus;
    }
}

echo "Solution : '$result'";