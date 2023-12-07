<?php
$input = fopen(__DIR__."/input", "r");

$result = 0;
$location = false;
$converter = [];

$line = trim(fgets($input), "\n");
$seeds = explode(' ', substr($line, 7));

$ranges = [];
for($i = 0; $i< count($seeds);$i = $i+2){
    $ranges[] = [
        "start" => $seeds[$i],
        "range" => $seeds[$i+1],
    ];
}
print_r($ranges);
die();




$input = fopen(__DIR__."/input", "r");
$line = trim(fgets($input), "\n");
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    if($line == '')
        continue;

    
    if(preg_match("#(\w+)-to-(\w+) map#", $line, $m)){
        $tmp_ranges = [];
        while(true) {
            $line = trim(fgets($input), "\n");
            $numbers = explode(' ', $line);
            $tmp_ranges[] = [
                'start' => $numbers[1],
                'range' => $numbers[2],
                'destination_start' => $numbers[0],
            ];
        }

        $new_ranges = [];
        foreach ($ranges as $key_range => $range) {
            foreach ($tmp_ranges as $tmp_range) {
                if($range['start'] >= $tmp_range['start'] && $range['start'] < $tmp_range['start'] + $tmp_range['range']){
                    $new_range['start'] = $range['start'] + ($tmp_range['destination_start'] - $tmp_range['start']);

                    if($range['start']+$range['range'] < $tmp_range['start'] + $tmp_range['range']){
                        $new_range['range'] = $range['range'];
                    }
                    else{
                        $new_range['range'] = ($tmp_range['start'] + $tmp_range['range']) - $range['start'];
                    }
                }
            }
        }
   


    }
}

