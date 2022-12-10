<?php
$input = fopen(__DIR__."/input", "r");

$cycle = 0;
$x = 1;
$row = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    preg_match('#(addx|noop)( ([\-0-9]*))?#', $line, $m);

    if($m[1] == 'noop'){
        addCycle();
    }
    elseif($m[1] == 'addx'){
        addCycle();
        addCycle();
        $x += $m[3];
    }
}

function addCycle(){
    global $cycle;
    global $x;
    global $row;

    $cycle++;
    $pixel = $cycle - (40*$row) - 1;
    if($x + 1 >= $pixel && $x - 1 <= $pixel)
        echo "#";
    else
        echo ".";

    if(is_int($cycle / 40)){
        echo "\n";
        $row++;
    }
}

?>