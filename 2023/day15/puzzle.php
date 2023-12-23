<?php
$line = file_get_contents('input');
$strings = explode(',', $line);
$result = 0;
// $strings = ['rn=1'];

foreach($strings as $string) {
    echo $string."\n";
    $current_value = 0;
    for($i=0;$i<strlen($string);$i++){
        $char = $string[$i];
        // echo $current_value."\n";
        $current_value += ord($char);
        // echo $current_value."\n";
        $current_value *= 17;
        // echo $current_value."\n";
        $current_value = $current_value % 256;
        // echo $current_value."\n";
        // $current_value -= $remainder;
        
        // echo $current_value."\n\n";
    }
    $result += $current_value;
}



echo "Solution : '$result'";