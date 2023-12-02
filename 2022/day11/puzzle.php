<?php
$input = fopen(__DIR__."/input", "r");

$monkeys = [];
$current_monkey_index = false;
while(!feof($input)) {
    $line = trim(fgets($input));

    if(strpos($line, 'Monkey') === 0){
        preg_match('#Monkey ([0-9]*)#', $line, $m);
        $current_monkey_index = $m[1];
        $monkeys[$current_monkey_index] = ['inpect' => 0];
    }
    elseif(strpos($line, 'Starting') === 0){
        $items = substr($line, 16);
        $monkeys[$current_monkey_index]['items'] = explode(', ', $items);
    }
    elseif(strpos($line, 'Operation') === 0){
        $operation = substr($line, 17);
        $monkeys[$current_monkey_index]['operation'] = explode(' ', $operation);
    }
    elseif(strpos($line, 'Test') === 0){
        $test = substr($line, 19);
        $monkeys[$current_monkey_index]['test'] = $test;

        $line = trim(fgets($input));
        $true = substr($line, 25);
        $monkeys[$current_monkey_index]['true'] = $true;


        $line = trim(fgets($input));
        $false = substr($line, 26);
        $monkeys[$current_monkey_index]['false'] = $false;
    }
}

for($i = 0 ; $i < 20; $i++){
    echo "round : $i \n";
    foreach($monkeys as $key => &$monkey) {
        echo "monkey : $key \n";
        foreach($monkey['items'] as $item){
            $old = $item;
            $monkey['inspect']++;
            if($monkey['operation'][2] == 'old')
                $n2 = $item;
            else
                $n2 = $monkey['operation'][2];

            switch($monkey['operation'][1]){
                case '+';
                    $item = $item + $n2;
                    break;
                case '-';
                    $item = $item - $n2;
                    break;
                case '*';
                    $item = $item * $n2;
                    break;
                case '/';
                    $item = $item / $n2;
                    break;
            }
            $item = floor($item/3);
            echo "$old - $item \n";
            if($item % $monkey['test'] === 0){
                $monkeys[$monkey['true']]['items'][] = $item;
            }
            else{
                $monkeys[$monkey['false']]['items'][] = $item;
            }
        }
        $monkey['items'] = [];
    }
}

$inspect = [];
foreach($monkeys as $monkey2){
    $inspect[] = $monkey2['inspect'];
}
rsort($inspect);
echo "Solution : ".$inspect[0]*$inspect[1];

?>