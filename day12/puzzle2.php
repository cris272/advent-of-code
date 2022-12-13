<?php
$input = fopen(__DIR__."/input", "r");

$map = [];
$paths = [];
$destination = false;
$start = false;
$solution = 999;
$i = 0;
$as = [];
while(!feof($input)) {
    $line = trim(fgets($input));

    if(strpos($line, 'S') !== false){
        $start = ['x' => strpos($line, 'S'), 'y' => $i, 'value' => 'a'];
        $line = str_replace('S', 'a', $line);
    }
    if(strpos($line, 'E') !== false){
        $destination = ['x' => strpos($line, 'E'), 'y' => $i, 'value' => 'z'];
        $line = str_replace('E', 'z', $line);
    }
    $chars = str_split($line);
    $map[] = $chars;
    foreach ($chars as $key => $char) {
        if($char == 'a')
            $as[] = ['x' => $key, 'y' => $i, 'value' => 'a'];
    }
    $i++;
}

$map_backup = $map;
foreach($as as $a){
    $paths = [];
    $paths[0] = [$a];
    $map = $map_backup;

    $continue = true;
    while($continue){
        $new_paths = [];
        if(count($paths) == 0)
            $continue = false;
        foreach ($paths as $path_key => $path_values) {
            $current = $path_values[count($path_values) - 1];
            foreach([['x' => 1, 'y' => 0], ['x' => -1, 'y' => 0], ['x' => 0, 'y' => 1], ['x' => 0, 'y' => -1]] as $value){
                $x = $current['x'] + $value['x'];
                $y = $current['y'] + $value['y'];

                if(isset($map[$y][$x]))
                    $test = $map[$y][$x];
                else
                    continue;

                $point_to_check = ['x' => $x, 'y' => $y, 'value' => $test];
                if(in_array($point_to_check, $path_values)){
                    continue;
                }

                if(($current['value'] >= $test || ord($current['value']) + 1 === ord($test)) && $map[$y][$x] !== true){
                    $new_path_values = $path_values;
                    $new_path_values[] = $point_to_check;
                    $new_paths[] = $new_path_values;
                    $map[$y][$x] = true;
                    if($point_to_check['x'] == $destination['x'] && $point_to_check['y'] == $destination['y']){
                        if(count($path_values) < $solution){
                            $solution = count($path_values);
                        }
                        $continue = false;
                    }
                }
            }
        }
        $paths = $new_paths;
    }
    echo $solution." - ".count($path_values)."\n";
}



echo "Solution : ".$solution;

?>