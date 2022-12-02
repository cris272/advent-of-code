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
    'B' => $paper,
    'C' => $scissor
];

$total = 0;
foreach ( $lines as  $key => $line ) {
    list($ennemy, $todo) =  explode(' ', trim($line));

    if($todo == 'X') { //lose
        $myself = ${$LETTERS[$ennemy]->win};
    }
    elseif($todo == 'Y') { //draw
        $myself = ${$LETTERS[$ennemy]->name};
        $total += 3;
    }
    elseif($todo == 'Z') { //win
        $myself = ${$LETTERS[$ennemy]->lose};
        $total += 6;
    }

    $total += $myself->point;
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

