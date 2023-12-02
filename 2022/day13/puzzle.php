<?php
$input = fopen(__DIR__."/input", "r");

$solution = 0;
$packets = [];
$i = 0;
while(!feof($input)) {
    $line = trim(fgets($input));
    if($line == ''){
        $i++;
        continue;
    }
    $packets[$i][] = json_decode($line);
}

foreach ($packets as $index => $packet) {
    if(compare($packet[0], $packet[1])){
        $solution += $index + 1;
    }
}
echo "Solution : $solution";


function compare($left,$right){
    if(is_array($left) && is_int($right))
        $right = [$right];
    if(is_int($left) && is_array($right))
        $left = [$left];

    if(is_array($left) && is_array($right)){
        foreach ($left as $key => $left_value) {
            if(isset($right[$key]))
                $right_value = $right[$key];
            else
                return false;

            if(is_array($left_value) || is_array($right_value)){
                $return = compare($left_value, $right_value);
                if($return === true || $return === false)
                    return $return;
            }
            else{
                if($left_value < $right_value)
                    return true;
                elseif($left_value > $right_value)
                    return false;
            }
        }
        if(count($left) < count($right))
            return true;
    }
    else{
        if($left < $right)
            return true;
        elseif($left > $right)
            return false;
    }
}
?>