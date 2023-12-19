<?php
$lines = file('input', FILE_IGNORE_NEW_LINES);

$image_tmp1 = [];
$image_tmp2 = [];
$galaxies = [];
$result = 0;

foreach ($lines as $key => $line) {
    $image_tmp1[] = str_split($line);
    if(strpos($line, '#') === false){
        $image_tmp1[] = str_split($line);
    }
}

$j = 0;
for($i = 0; $i < strlen($line);$i++){

    $column = array_column($image_tmp1, $i);
    create_column($column);
    if(!in_array('#', $column)) {
        create_column($column);
    }

}

foreach($image_tmp2 as $y => $row) {
    foreach($row as $x => $char) {
        // echo $char;
        if($char == '#'){
            $galaxies[] = ['x' => $x, 'y' => $y];
        }
    }
    // echo "\n";
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

function create_column($column){
    global $image_tmp2, $j;
    $j++;
    foreach ($column as $key => $char) {
        $image_tmp2[$key][$j] = $char;
    }
}


echo "Solution : '$result'";