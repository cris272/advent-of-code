<?php
$input = fopen(__DIR__."/input", "r");
$line = trim(fgets($input), "\n");

$solution = false;
$i = 3;
while($solution === false) {
    $letters = [];
    
    for($j = 0 ; $j < 14 ; $j++) {
        if(!isset($letters[$line[$i - $j]])) {
            $letters[$line[$i - $j]] = true;
            if($j == 13)
                $solution = $i + 1;
        }
        else{
            $i++;
            break;
        }
    }
}

echo "Solution : '$solution'";
?>

