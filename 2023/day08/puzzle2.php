<?php

class Node {
    public $left; 
    public $right;

    public function __construct($line){
        if(preg_match('#([0-9A-Z]{3}), ([0-9A-Z]{3})#', $line, $m)){
            $this->left = $m[1];
            $this->right = $m[2];
        }
        else{
            var_dump($line);
        }
    }
}

function lcm($a, $b) {
    return $a * $b / gcd($a, $b);
}

function gcd ($a, $b) {
    return $b ? gcd($b, $a % $b) : $a;
}

$input = fopen(__DIR__."/input", "r");
$instructions = trim(fgets($input), "\n");
$results = [];
$nodes = [];
$current_positions = [];
fgets($input);
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    $postition = substr($line, 0, 3);
    $nodes[$postition] = new Node($line);
    if(substr($postition, -1) == 'A'){
        $current_positions[] = $postition;
    }
}

foreach ($current_positions as $key => $current_position) {
    $j = 0;
    while(true){
        for($i=0;$i<strlen($instructions);$i++){
            $j++;
            if($instructions[$i] == 'L')
                $current_positions[$key] = $nodes[$current_positions[$key]]->left;
            else
                $current_positions[$key] = $nodes[$current_positions[$key]]->right;

            if(substr($current_positions[$key], -1) == 'Z'){
                $results[$key] = $j;
                break 2;
            }

        }
    }
}

$result = 1;
foreach ($results as $key => $value) {
    $result = lcm($result, $value);
}
echo $result."\n";

