<?php
$input = fopen(__DIR__."/input", "r");

$score = 0;
while(!feof($input)) {
    $line = trim(fgets($input));
    
    preg_match('#^([0-9]*)-([0-9]*),([0-9]*)-([0-9]*)$#', $line, $m);
    if( 
        ($m[1] >= $m[3] && $m[1] <= $m[4]) || 
        ($m[2] >= $m[3] && $m[2] <= $m[4]) || 
        ($m[3] >= $m[1] && $m[3] <= $m[2]) || 
        ($m[4] >= $m[1] && $m[4] <= $m[2]) 
    ){
        print_r($m);
        $score++;
    }
}

echo "Solution : '$score'";
?>

