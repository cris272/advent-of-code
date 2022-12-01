<?php
$lines = file( __DIR__."/input" );

$max = $current = 0;
foreach ( $lines as  $key => $line ) {
    $line = trim($line);
    if($line == '' || $key === array_key_last($lines)) {
        if($current > $max)
            $max = $current;

        $current = 0;
        continue;
    }
    $current += $line;
}

echo "Solution : '$max'";

?>

