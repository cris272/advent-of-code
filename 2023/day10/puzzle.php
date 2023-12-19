<?php
$lines = file('input', FILE_IGNORE_NEW_LINES);

$descriptor = [
    "right" => [
        '-' => 'right',
        'J' => 'up',
        '7' => 'down',
    ],
    "left" => [
        '-' => 'left',
        'L' => 'up',
        'F' => 'down',
    ],
    "up" => [
        '|' => 'up',
        'F' => 'right',
        '7' => 'left',
    ],
    "down" => [
        '|' => 'down',
        'L' => 'right',
        'J' => 'left',
    ],
];

$vectors = [
    "up" => [
        'x' => 0,
        'y' => -1,
      ],
    "right" => [
      'x' => 1,
      'y' => 0,
    ],
    "left" => [
        'x' => -1,
        'y' => 0,
      ],
    "down" => [
        'x' => 0,
        'y' => 1,
      ],
];


$coord_S = false;
foreach ($lines as $key => $line) {
    $pos = strpos($line, 'S');
    if($pos !== false){
        $coord_S = ['x' => $pos, 'y' => $key];
        break;
    }
}

foreach ($vectors as $direction => $vector) {
    $current_position = $coord_S;
    $pipes_coord = [];
    $pipes = [];
    while(true) {
        $current_position = [
            'x' => $current_position['x'] + $vectors[$direction]['x'],
            'y' => $current_position['y'] + $vectors[$direction]['y'],
        ];

        $pipe = $lines[$current_position['y']][$current_position['x']];

        if($pipe == 'S') {
            break 2;
        }
        elseif(!isset($descriptor[$direction][$pipe])) {
            break;
        }
  
        $pipes[] = $pipe;
        $pipes_coord[] = $current_position;
        $direction = $descriptor[$direction][$pipe];
    }
}

echo "Solution : '".(((count($pipes)-1) / 2) + 1)."'";