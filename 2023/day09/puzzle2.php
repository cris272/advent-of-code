<?php
$lines = file('input', FILE_IGNORE_NEW_LINES);

$results = [];
foreach ($lines as $key => $line) {
    $sequences = [];
    $sequences[] = $numbers = explode(' ', $line);
    while(true){
        $new_sequence = [];
        $end = true;
        for($i = 0; $i < count($numbers)-1; $i++) {
            $diff = $numbers[$i+1] - $numbers[$i];
            $new_sequence[] = $numbers[$i+1] - $numbers[$i];
            if($diff != 0)
                $end = false;
        }
        $sequences[] = $new_sequence;
        $numbers = $new_sequence;
        if($end) {
            break;
        }
    }

    $sequences[count($sequences) - 1][-1] = 0;
    for ($i=count($sequences) - 2; $i >= 0; $i--) { 
        $sequences[$i][-1] = $sequences[$i][0] - $sequences[$i+1][-1];
    }
    $results[] = $sequences[0][- 1];
}

echo "Solution : '".array_sum($results)."'";