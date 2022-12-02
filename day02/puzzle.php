<?php
$lines = file( __DIR__."/input" );


const PAPER = 'paper';
const SCISSOR = 'scissor';
const ROCK = 'rock';

$rock = new item(ROCK, 1, 'A', 'X');
$paper = new item(PAPER, 2, 'B', 'Y');
$scissor = new item(SCISSOR, 3, 'C', 'Z');

$rock->lose = PAPER;
$rock->win = SCISSOR;

$paper->lose = SCISSOR;
$paper->win = ROCK;

$scissor->lose = ROCK;
$scissor->win = PAPER;

$LETTERS = [
    'A' => $rock,
    'X' => $rock,
    'B' => $paper,
    'Y' => $paper,
    'C' => $scissor,
    'Z' => $scissor
];

$total = 0;
foreach ( $lines as  $key => $line ) {
    list($ennemy, $myself) =  explode(' ', trim($line));

    $total += $LETTERS[$myself]->point;
    if($LETTERS[$myself]->win == $LETTERS[$ennemy]->name) {
        $total += 6;
    }
    elseif($LETTERS[$myself]->name == $LETTERS[$ennemy]->name) {
        $total += 3;
    }
}
echo "Solution : '$total'";


class item{
    public $name;
    public $point;
    public $win;
    public $lose;

    public function __construct($n, $p, $e, $m) {
        $this->name = $n;
        $this->point = $p;
        $this->ennemy = $e;
        $this->myself = $m;
    }
}

?>

