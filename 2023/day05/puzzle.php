<?php
$input = fopen(__DIR__."/input", "r");

$location = false;

$line = trim(fgets($input), "\n");
$seeds = explode(' ', substr($line, 7));

foreach ($seeds as $seed) {
    $source = $seed;

    $input = fopen(__DIR__."/input", "r");
    $line = trim(fgets($input), "\n");
    while(!feof($input)) {
        $line = trim(fgets($input), "\n");
        if($line == '')
            continue;

        if(preg_match("#(\w+)-to-(\w+) map#", $line, $m)){
            $destination = false;
            while(true) {
                $line = trim(fgets($input), "\n");
                if($line == "" || feof($input)){
                    break;
                }
                $numbers = explode(' ', $line);

                if($source >= $numbers[1] && $source < $numbers[1] + $numbers[2]){
                    $destination = $source + ($numbers[0] - $numbers[1]);
                    break;
                }
            }
            if(!$destination){
                $destination = $source;
            }
            $source = $destination;
            if($m[2] == 'location'){
                if($location === false || $location > $destination){
                    $location = $destination;
                }
            }
        }
    }
}

echo "Solution : '$location'";