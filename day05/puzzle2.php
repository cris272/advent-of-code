<?php
$input = fopen(__DIR__."/input", "r");

$stacks = array_fill(0, 9, []);
while(!feof($input)) {
    $line = trim(fgets($input), "\n");

    if($line == '')
       break;

    $offset = 0;
    $length = 4;
    $i = 0;
    while($substr = substr($line, $offset, $length)){
        $offset += $length;
        if(preg_match('#\[(.*)\] ?#', $substr, $m)){
            $stacks[$i][] = $m[1];
        }
        $i++;
    }
}

foreach ($stacks as $key => $stack) {
    $stacks[$key] = array_reverse($stack);
}

while(!feof($input)) {
    $line = trim(fgets($input));
    echo $line."\n";
    if(preg_match('#^move ([0-9]*) from ([0-9]*) to ([0-9]*)$#', $line, $m)){
        $move = $m[1];
        $from = $m[2];
        $to = $m[3];
        
        $slice = array_slice($stacks[$from - 1], count($stacks[$from - 1]) - $move, $move);
        array_splice($stacks[$from - 1], count($stacks[$from - 1]) - $move, $move);
        $stacks[$to - 1] = array_merge($stacks[$to - 1], $slice);
    }
}

$solution = '';
foreach ($stacks as $key => $stack)
    $solution .= end($stack);


echo "Solution : '$solution'";
?>

