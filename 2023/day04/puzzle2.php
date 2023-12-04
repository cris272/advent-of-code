<?php
$lines = file( __DIR__."/input" );

$new_lines = [];
$result = 0;
foreach ( $lines as $line ) {
    $line = trim($line);
    preg_match('#Card ([ 0-9]+): ([ 0-9]+) \| ([ 0-9]+)#', $line, $m);
    $winning_numbers = explode(' ', $m[2]);
    $numbers = explode(' ', $m[3]);
    $intersect = array_intersect($winning_numbers, $numbers);

    foreach($intersect as $key => $n) {
        if($n == '') {
            unset($intersect[$key]);
            continue;
        }
    }

    $new_lines[trim($m[1])] = [
        'copy' => 1,
        'intersect' => $intersect,
    ];
}

foreach ( $new_lines as $card => $line ) {
    $points = 0;
    if(count($line['intersect']) > 0){ 
        for($intersect = 1; $intersect <= count($line['intersect']); $intersect++){
            $new_lines[$card + $intersect]['copy'] += $new_lines[$card]['copy'];
        }
        foreach($line['intersect'] as $n) {
            $points = ($points == 0 ? 1:$points*2);
        }
    }
    $result += $new_lines[$card]['copy'];
}

echo "Solution : '$result'";