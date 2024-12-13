<?php
$lines = file(__DIR__."/input");

$result = 0;
$words = [];
for($y = 0 ; $y < count($lines) ; $y++) {
    $offset = 0;
    while(($x = strpos($lines[$y], 'A', $offset)) !== false) {
        $word = new word($x, $y);
        $words[] = $word;
        $offset = $x+1;
    }
}

foreach($words as $word) {
    if($word->validate($lines))
        $result ++;
}
echo "Solution : '$result'";

class word {
    public $startX;
    public $startY;
    public $currentLetter = 1;
    const LETTERS = ['M', 'S'];
    const DIRECTIONS = [
        [
            ['x' => 1, 'y' => 1],
            ['x' => -1, 'y' => -1],
        ],
        [
            ['x' => 1, 'y' => -1],
            ['x' => -1, 'y' => 1],
        ]
    ];

    public function __construct($x, $y)
    {
        $this->startX = $x;
        $this->startY = $y;
    }

    public function validate($lines) {
        foreach (self::DIRECTIONS as $directions) {
            $s = $m = false;
            foreach ($directions as $direction) {
                $newPosition = ['x' => $this->startX, 'y' => $this->startY];
                $newPosition = [
                    'x' => $newPosition['x'] + $direction['x'],
                    'y' => $newPosition['y'] + $direction['y']
                ];

                if(isset($lines[$newPosition['y']][$newPosition['x']])) {
                    if($lines[$newPosition['y']][$newPosition['x']] == 'S')
                        $s = true;
                    elseif($lines[$newPosition['y']][$newPosition['x']] == 'M')
                        $m = true;
                }
                else{
                    break;
                }
            }

            if(!$s || !$m) 
                return false;
        }
        return true;
    }
}