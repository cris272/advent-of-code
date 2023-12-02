<?php

$operations = [];

array_map(function($line) use (&$operations){
    preg_match('#(.*): (.*)#', $line, $m);
    //print_r($m);
    //$operation =
    $explode = explode(' ', $m[2]); 
    $operations[$m[1]] = count($explode) == 1 ? $explode[0]:$explode;
}, file(__DIR__."/input"));


//print_r($operations);
$solution = 0;
$todo = $operations;

while(true){

    $operations = array_map(function($operation) use ($operations){
        if(is_array($operation)){
            foreach ([0,2] as $key) {
                if(!is_numeric($operation[$key]) && is_numeric($operations[$operation[$key]]))
                    $operation[$key] = $operations[$operation[$key]];
            }
            if(is_numeric($operation[0]) && is_numeric($operation[2])){
                switch($operation[1]){
                    case '+':
                        $operation = $operation[0] + $operation[2];
                        break;
                    case '-':
                        $operation = $operation[0] - $operation[2];
                        break;
                    case '*':
                        $operation = $operation[0] * $operation[2];
                        break;
                    case '/':
                        $operation = $operation[0] / $operation[2];
                        break;
                }
            }
        }
        return $operation;
    }, $operations);

    if(is_numeric($operations['root'])){
        print_r($operations);
        $solution = $operations['root'];
        break;
    }

}

echo "\nSolution : ".$solution;