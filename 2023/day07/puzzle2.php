<?php

$values = ['A', 'K', 'Q', 'T', '9', '8', '7', '6', '5', '4', '3', '2', 'J'];

class Hand {
    public $hand; 
    public $bid;
    public $abs_rank;

    public function __construct($line){
        $e = explode(' ', $line);
        $this->hand = $e[0];
        $this->bid = $e[1];
        $this->abs_rank = $this->calcul_rank();
    }

    private function calcul_rank(){
        $counts = [0 => 0];
        $count_J = 0;
        for($i = 0; $i < strlen($this->hand) ; $i++){
            if($this->hand[$i] == 'J') {
                $count_J++;
                continue;
            }
            if(!isset($counts[$this->hand[$i]]))
                $counts[$this->hand[$i]] = 0;
            $counts[$this->hand[$i]]++;
        }
        rsort($counts);
        $counts[0]+=$count_J;
        return $counts[0].($counts[1] ?? 0);

    }
}


$input = fopen(__DIR__."/input", "r");

$result = 0;
$hands = [];
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    $hands[] = new Hand($line);
}

usort($hands, function($a, $b) use ($values) {
    if($a->abs_rank > $b->abs_rank){
        return 1;
    }
    elseif($a->abs_rank < $b->abs_rank){
        return -1;
    }
    else{
        for($i = 0; $i < strlen($a->hand) ; $i++){
            $a_value = array_search($a->hand[$i], $values);
            $b_value = array_search($b->hand[$i], $values);

            if($a_value > $b_value){
                return -1;
            }
            elseif($a_value < $b_value){
                return 1;
            }
        }
        return 0;
    }
});

foreach ($hands as $key => $hand) {
    $result += ($key + 1) * $hand->bid;
}

echo "Solution : '$result'";

