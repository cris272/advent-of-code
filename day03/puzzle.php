<?php
$input = fopen(__DIR__."/input", "r");

$score = 0;
while(!feof($input)) {
    $line = trim(fgets($input));
    
    $nb_char = strlen($line);
    $compartmens1 = substr($line, 0, $nb_char/2);
    $compartmens2 = substr($line, $nb_char/2, );

    var_dump($compartmens1);
    var_dump($compartmens2);

    $compartmens1_array = str_split($compartmens1);
    foreach($compartmens1_array as $item){
        if(strpos($compartmens2, $item) !== false){
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

