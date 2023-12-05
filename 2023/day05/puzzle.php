<?php
$input = fopen(__DIR__."/input", "r");

$result = 0;
$converter = [];

$line = trim(fgets($input), "\n");
$seeds = explode(' ', substr($line, 7));
print_r($seeds);


while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    if($line == '')
        continue;

    if(preg_match("#(\w+)-to-(\w+) map#", $line, $m)){
        print_r($m);
        while(true) {
            $line = trim(fgets($input), "\n");
            if($line == "" || feof($input)){
                break;
            }
            $numbers = explode(' ', $line);
            for($i = 0; $i < $numbers[2]; $i++){
                $converter[$m['0']][$m['1']][$numbers[0] + $i] = $numbers[1] + $i;
            }
        }
    }


}
print_r($converter);

// echo "Solution : '$result'";

