<?php
$lines = file( __DIR__."/input" );

$result = 0;
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
                $search_in = trim(substr($lines[$i], $x - ($x == 0 ? 0:1), strlen($number)+($x == 0 ? 1:2)));
                
                if(preg_match("#[^.0-9]#", $search_in, $m)) {
                    $possible = true;
                    break;
                }
            }
            if($possible) {
                $result += $number;
            }
        }
    }
}

echo "Solution : '$result'";