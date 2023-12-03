<?php
$lines = file( __DIR__."/input" );

$result = 0;
$asterix = [];
foreach ( $lines as $y => $line ) {
    $line = trim($line);
    $offset = 0;

    if(preg_match_all('#([0-9]+)#', $line, $m)) {
        $x = 0;
        foreach ($m[0] as $number) {
            $possible = false;
            $x = strpos($line, $number, $offset);
            $offset = $x + strlen($number);
            for($i = $y - 1; $i <= $y + 1; $i++ ){
                if($i == -1 || $i > count($lines) - 1)
                    continue;

                for($j = $x - 1; $j <=  strlen($number) + $x; $j++){
                    if(!empty($lines[$i][$j]) && $lines[$i][$j] == "*"){
                        $asterix[$i][$j][] = $number;
                    }
                }
            }
        }
    }
}

foreach($asterix as $line) {
    foreach($line as $col) {
        if(count($col) == 2){
            $result += $col[0]*$col[1];
        }
    }
}

echo "Solution : '$result'";