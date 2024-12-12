<?php
$input = trim(file_get_contents('input'));
$input = preg_replace('/don\'t\(\)(?:.|\n)*?do\(\)/', '', $input);

$result = 0;
preg_match_all('/(mul\((\d{1,3}),(\d{1,3})\))/', $input, $matches);

foreach ($matches[2] as $key => $match) {
    $result += $match * $matches[3][$key];
}
echo "Solution : '$result'";