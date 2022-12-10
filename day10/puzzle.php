<?php
$input = fopen(__DIR__."/input", "r");

$cycle = 0;
$x = 1;
$solution = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    preg_match('#(addx|noop)( ([\-0-9]*))?#', $line, $m);

    if($m[1] == 'noop'){
        addCycle();
    }
    elseif($m[1] == 'addx'){
        addCycle();
        addCycle();
        // $cycle += 2;
        $x += $m[3];
    }
}
echo "Solution : '".$solution."'";

function addCycle(){
    global $cycle;
    global $x;
    global $solution;

    $cycle++;
    if(is_int($cycle / 20) && !is_int($cycle / 40)){
        echo "\n".$cycle." - ".$x." signal = ".$cycle*$x;
        $solution += $cycle*$x;
    }
}

?>