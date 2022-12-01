<?php
$lines = file( __DIR__."/input" );

$elves = [];
$current = 0;
$i = 0;
foreach ( $lines as  $key => $line ) {
    $line = trim($line);
    if($line == '' || $key === array_key_last($lines)) {
        $elves[$i] = $current;

        $current = 0;
        $i++;
        continue;
    }
    $current += $line;
}
rsort($elves);
$top3 = array_slice($elves, 0, 3);
print_r($top3);

echo "Solution : '".array_sum($top3)."'";

?>

