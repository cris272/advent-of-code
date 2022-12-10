<?php
$input = fopen(__DIR__."/input", "r");

$Hy = $Hx = $Ty = $Tx = 0;
$Tpositions = ["$Tx.$Ty" => 1];
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    preg_match('#([URLD]) ([0-9]*)#', $line, $m);

    for($i = 0;$i < $m[2]; $i++){

        if($m[1] == 'L')
            $Hx--;
        if($m[1] == 'R')
            $Hx++;
        if($m[1] == 'U')
            $Hy--;
        if($m[1] == 'D')
            $Hy++;


        if($Hy - $Ty == 2){
            $Ty++;
            $Tx = $Hx;
        }
        elseif($Hy - $Ty == -2){
            $Ty--;
            $Tx = $Hx;
        }
        elseif($Hx - $Tx == -2){
            $Tx--;
            $Ty = $Hy;
        }
        elseif($Hx - $Tx == 2){
            $Tx++;
            $Ty = $Hy;
        }

        $Tpositions["$Tx.$Ty"] = 1;
    }

}
print_r($Tpositions);
echo "Solution : '".count($Tpositions)."'";

?>