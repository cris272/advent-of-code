<?php
$lines = file( __DIR__."/input" );

$solution = 0;
foreach ( $lines as $line_key => $line ) {
    $line = trim($line);
    $letters = str_split($line);
    foreach($letters as $letter_key => $letter) {
        if(
            !isset($lines[$line_key + 1]) || 
            !isset($lines[$line_key - 1]) ||
            !isset($letters[$letter_key + 1]) ||
            !isset($letters[$letter_key - 1])
        ){
            $solution++;
        }
        else{
            $visible = true;

            $up = $down = $left = $right = [];
            for($i = 0; $i < $line_key; $i++)
                $up[$i] = $lines[$i][$letter_key];
            for($i = $line_key + 1; $i < count($lines); $i++)
                $down[$i] = $lines[$i][$letter_key];
            $left = array_slice($letters, 0, $letter_key);
            $right = array_slice($letters, $letter_key+1, count($letters) - $letter_key);
           
            foreach([$up, $down, $left, $right] as $values){
                $visible = true;
                foreach ($values as $value) {
                    if($value >= $letter) {
                        $visible = false;
                        break;
                    }
                }
                if($visible){
                    $solution++;
                    break;
                }
            }
        }
    }
}

echo "Solution : '$solution'";
?>