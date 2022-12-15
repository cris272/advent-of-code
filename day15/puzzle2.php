<?php
$solution = 0;
$sensors = [];
$input = array_map(function($line) use (&$sensors){ 
    preg_match('#Sensor at x=([\-0-9]*), y=([\-0-9]*): closest beacon is at x=([\-0-9]*), y=([\-0-9]*)#', trim($line), $m);

    $sensors[] = [
        'x' => $m[1],
        'y' => $m[2],
        'distance' => abs($m[1]-$m[3]) + abs($m[2]-$m[4])
    ];
}, file(__DIR__."/input"));

$max = 4000000;
for($y = 0;$y <= $max; $y++){
        echo "Y $y \n";
        $lines = [];
        foreach ($sensors as $key => $sensor) {
            if(
                ($y < $sensor['y'] - $sensor['distance']) ||
                ($y > $sensor['y'] + $sensor['distance']) 
            )
                continue;
            else{
                $x_start = $sensor['x'] - ($sensor['distance'] - (abs($sensor['y']-$y)));
                $x_start =  $x_start < 0 ? 0:$x_start;
                $x_start =  $x_start > $max ? $max:$x_start;
                $x_stop = $sensor['x'] + ($sensor['distance'] - (abs($sensor['y']-$y)));
                $x_stop =  $x_stop < 0 ? 0:$x_stop;
                $x_stop =  $x_stop > $max ? $max:$x_stop;

                $lines[] = ['x_start' => $x_start, 'x_stop' => $x_stop];
                continue;
            }
        }

        usort($lines, function($a, $b){
            return $a['x_start'] > $b['x_start'];
        });

        $x = 0;
        foreach ($lines as $key => $value) {
            if($value['x_start'] > $x){
                $solution = ($value['x_start'] - 1) * 4000000 + $y;
                    break 2;
            }
            else{
                $x = $value['x_stop'] > $x ? $value['x_stop']:$x;
            }
        }
}

echo "\nSolution : $solution";