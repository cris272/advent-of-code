<?php

$min = 0;
$max= 10000000000000000;
$mid = ($min+$max) / 2;
while(true){
    $operations = [];

    array_map(function($line) use (&$operations){
        preg_match('#(.*): (.*)#', $line, $m);
        $explode = explode(' ', $m[2]); 
        $operations[$m[1]] = count($explode) == 1 ? $explode[0]:$explode;
    }, file(__DIR__."/input"));

    $operations['humn'] = $mid;
    $operations['root'][1] = '=';
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
        if(is_numeric($operations['root'][0]) && is_numeric($operations['root'][2])){
            if($operations['root'][0] == $operations['root'][2])
                break 2;
            else{
                $score = $operations['root'][2] - $operations['root'][0];
                if($score < 0)
                    $min = $mid;
                else
                    $max = $mid;

                
                $mid = ceil(($min+$max) / 2);
                break;
            }
        }
    }
}

echo "\nSolution : ".$mid;