<?php
ini_set('memory_limit', '5024M');

$input = fopen(__DIR__."/input", "r");

$map = [];
$paths = [];
$destination = false;
$start = false;

$i = 0;
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
    // $map[] = $line;
    $map[] = str_split($line);
    $i++;
}
// print_r($map);
// print_r($destination);
// print_r($start);

$paths[0] = [$start];
$continue = true;
while($continue){
    $new_paths = [];
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

            // echo "x=$x, y=$y, value=$test \n";
            if(($current['value'] >= $test || ord($current['value']) + 1 === ord($test)) && $map[$y][$x] !== true){
                // echo "i=".count($path_values).", x=$x, y=$y, value=$test \n";
                // $new_paths[] = array_merge($path_values, ['x' => $x, 'y' => $y, 'value' => $value]);
                $new_path_values = $path_values;
                $new_path_values[] = $point_to_check;
                $new_paths[] = $new_path_values;
                $map[$y][$x] = true;
                if($point_to_check['x'] == $destination['x'] && $point_to_check['y'] == $destination['y']){

                    $continue = false;
                    // print_r($new_paths);
                    // print_r($destination);
                    // print_r($point_to_check);
                }
            }

         
        }
    }
    $paths = $new_paths;
}



echo "Solution : ".count($path_values);

?>