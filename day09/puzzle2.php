<?php
$input = fopen(__DIR__."/input", "r");

$knots_positions = array_fill(0, 10, ['x' => 0, 'y' => 0]);

$Tpositions = [$knots_positions[9]['x'].".".$knots_positions[9]['y'] => 1];
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    preg_match('#([URLD]) ([0-9]*)#', $line, $m);

    for($i = 0;$i < $m[2]; $i++){

        if($m[1] == 'L')
            $knots_positions[0]['x']--;
        if($m[1] == 'R')
            $knots_positions[0]['x']++;
        if($m[1] == 'U')
            $knots_positions[0]['y']--;
        if($m[1] == 'D')
            $knots_positions[0]['y']++;

        for($j = 1 ; $j < 10 ; $j++) {
            if($knots_positions[$j-1]['y'] - $knots_positions[$j]['y'] == 2){
                $knots_positions[$j]['y']++;

                if($knots_positions[$j-1]['x'] - $knots_positions[$j]['x'] > 0)
                    $knots_positions[$j]['x']++;
                elseif($knots_positions[$j-1]['x'] - $knots_positions[$j]['x'] < 0)
                    $knots_positions[$j]['x']--;
            }
            elseif($knots_positions[$j-1]['y'] - $knots_positions[$j]['y']== -2){
                $knots_positions[$j]['y']--;
                
                if($knots_positions[$j-1]['x'] - $knots_positions[$j]['x'] > 0)
                    $knots_positions[$j]['x']++;
                elseif($knots_positions[$j-1]['x'] - $knots_positions[$j]['x'] < 0)
                    $knots_positions[$j]['x']--;
            }
            elseif($knots_positions[$j-1]['x'] - $knots_positions[$j]['x'] == -2){
                $knots_positions[$j]['x']--;
                
                if($knots_positions[$j-1]['y'] - $knots_positions[$j]['y'] > 0)
                    $knots_positions[$j]['y']++;
                elseif($knots_positions[$j-1]['y'] - $knots_positions[$j]['y'] < 0)
                    $knots_positions[$j]['y']--;
            }
            elseif($knots_positions[$j-1]['x'] - $knots_positions[$j]['x']== 2){
                $knots_positions[$j]['x']++;
                
                if($knots_positions[$j-1]['y'] - $knots_positions[$j]['y'] > 0)
                    $knots_positions[$j]['y']++;
                elseif($knots_positions[$j-1]['y'] - $knots_positions[$j]['y'] < 0)
                    $knots_positions[$j]['y']--;
            }
        }
        $Tpositions[$knots_positions[9]['x'].".".$knots_positions[9]['y']] = 1;
    }

}

echo "Solution : '".count($Tpositions)."'";

?>