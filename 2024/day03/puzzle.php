<?php
$input = fopen(__DIR__."/input", "r");

$result = 0;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");
    preg_match_all('/(mul\((\d{1,3}),(\d{1,3})\))/', $line, $matches);

    foreach ($matches[2] as $key => $match) {
        $result += $match * $matches[3][$key];
    }
}

echo "Solution : '$result'";