<?php
$lines = file(__DIR__."/input");

$result = 0;
$words = [];
for($y = 0 ; $y < count($lines) ; $y++) {
    $offset = 0;
    while(($x = strpos($lines[$y], 'X', $offset)) !== false) {
        $word = new word($x, $y);
        $words[] = $word;
        $offset = $x+1;
    }
}

foreach($words as $word) {
    $r = $word->validate($lines);
    $result += $r;
}
echo "Solution : '$result'";

class word {
    public $startX;
    public $startY;
    const LETTERS = ['M', 'A', 'S'];
    const DIRECTIONS = [
        ['x' => 1, 'y' => 1],
        ['x' => 1, 'y' => 0],
        ['x' => 1, 'y' => -1],
        ['x' => -1, 'y' => 1],
        ['x' => -1, 'y' => 0],
        ['x' => -1, 'y' => -1],
        ['x' => 0, 'y' => 1],
        ['x' => 0, 'y' => -1],
    ];

    public function __construct($x, $y)
    {
        $this->startX = $x;
        $this->startY = $y;
    }

    public function validate($lines) {
        $result = 0;
        foreach (self::DIRECTIONS as $direction) {
            $newPosition = ['x' => $this->startX, 'y' => $this->startY];
            foreach (self::LETTERS as $letterToSearch) {
                
                $newPosition = [
                    'x' => $newPosition['x'] + $direction['x'],
                    'y' => $newPosition['y'] + $direction['y']
                ];
                if(isset($lines[$newPosition['y']][$newPosition['x']])) {
                    if($lines[$newPosition['y']][$newPosition['x']] != $letterToSearch) {
                        break;
                    }
                }
                else{
                    break;
                }
               
                if($letterToSearch == 'S'){
                    $result++;
                }
            }
        }
        return $result;
    }
}

