<?php
$input = fopen(__DIR__."/input", "r");

$score = 0;
$i = 0;
while(!feof($input)) {
    $i++;
    $line1 = trim(fgets($input));
    $line2 = trim(fgets($input));
    $line3 = trim(fgets($input));
    
    $line1_array = str_split($line1);
    
    foreach($line1_array as $item){
        if(strpos($line2, $item) !== false && strpos($line3, $item) !== false){
            if(ord($item) >= 97 && ord($item) <= 122){
                $pos = ord($item) - ord('a') + 1;
            }
            else {
                $pos = ord($item) - ord('A') + 1 + 26;
            }
            echo $item ."-".$pos;
            echo "\n";
            $score += $pos;
            break;
        }
    }
}

echo "Solution : '$score'";

?>

