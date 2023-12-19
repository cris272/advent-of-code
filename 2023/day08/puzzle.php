<?php

class Node {
    public $left; 
    public $right;

    public function __construct($line){
        if(preg_match('#([A-Z]{3}), ([A-Z]{3})#', $line, $m)){
            $this->left = $m[1];
            $this->right = $m[2];
        }
    }
}

$input = fopen(__DIR__."/input", "r");
$instructions = trim(fgets($input), "\n");
$result = 0;
$nodes = [];
$current_node_key = 'AAA';
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    $nodes[substr($line, 0, 3)] = new Node($line);
}

while(true){
    for($i=0;$i<strlen($instructions);$i++){

        if($instructions[$i] == 'L')
            $current_node_key = $nodes[$current_node_key]->left;
        else
            $current_node_key = $nodes[$current_node_key]->right;

        $result++;
        if($current_node_key == 'ZZZ')
            break 2;
    }
}

echo "Solution : '$result'";