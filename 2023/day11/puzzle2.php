<?php
$lines = file('input', FILE_IGNORE_NEW_LINES);

$image_tmp1 = [];
$galaxies_tmp = [];
$galaxies = [];
$result = 0;
$expansion = 1000000 - 1;

foreach ($lines as $key => $line) {
    $image_tmp1[] = str_split($line);
}

foreach($image_tmp1 as $y => $row) {
    foreach($row as $x => $char) {
        // echo $char;
        if($char == '#'){
            $galaxies_tmp[] = ['x' => $x, 'y' => $y];
        }
    }
    // echo "\n";
}
$galaxies = $galaxies_tmp;

foreach($image_tmp1 as $y => $row) {
    if(!in_array('#', $row)){
        add_expansion('y', $y);
    }
}

for($x = 0; $x < strlen($line);$x++){

    $column = array_column($image_tmp1, $x);
    
    if(!in_array('#', $column)) {
        add_expansion('x', $x);
    }

}

while(count($galaxies) > 1) {
    $first = array_key_first($galaxies);
    foreach ($galaxies as $key => $galaxie) {
        if($key == $first){
            continue;
        }
        $length = abs($galaxies[$first]['x'] - $galaxie['x']) + abs($galaxies[$first]['y'] - $galaxie['y']);
        $result += $length;
    }
    unset($galaxies[$first]);
}

echo "Solution : '$result'";


function add_expansion($axe, $limit){
    global $galaxies_tmp, $galaxies, $expansion;

    foreach ($galaxies_tmp as $key => $galaxie) {
        if($galaxie[$axe] >= $limit) {
            $galaxies[$key][$axe] = $galaxies[$key][$axe] + $expansion;
        }
    }
}