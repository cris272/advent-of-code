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
            // $solution++;
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
            $left = array_reverse($left);
            $up = array_reverse($up);

            $scenic = 1;
            foreach([$up, $down, $left, $right] as $values){
                $i = 0;
                foreach ($values as $key => $value) {
                    $i++;
                    if($value >= $letter || $key == array_key_last($values)) {
                        $scenic = $scenic * $i;
                        break;
                    }
                }
            }
            if($scenic > $solution)
                $solution = $scenic;
        }
    }
}

echo "Solution : '$solution'";
?>