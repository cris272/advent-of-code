<?php
$lines = file('input', FILE_IGNORE_NEW_LINES);

$reflections = ['x' => [], 'y' => []];
$mirrors = [];
$i=0;
foreach ($lines as $key => $line) {
    if($line == ''){
        $i++;
        $mirrors[$i] = [];
        continue;
    }
    $mirrors[$i][] = str_split($line);
}

foreach ($mirrors as $mirror_index => $mirror_original) {
    for($mirror_x = 0;$mirror_x<count($mirror_original[0]) ; $mirror_x++){
        for($mirror_y = 0;$mirror_y<count($mirror_original) ; $mirror_y++){

            $mirror = $mirror_original;
            if ($mirror[$mirror_y][$mirror_x] === '.') {
                $mirror[$mirror_y][$mirror_x] = '#';
            } else {
                $mirror[$mirror_y][$mirror_x] = '.';
            }

            foreach(['x', 'y'] as $axe){
                if($axe == 'x'){
                    $middle = round(count($mirror[0]) / 2, PHP_ROUND_HALF_DOWN);
                    $max = count($mirror[0]);
                    $max2 = count($mirror);
                }
                else{
                    $middle = round(count($mirror) / 2, PHP_ROUND_HALF_DOWN);
                    $max = count($mirror);
                    $max2 = count($mirror[0]);
                }

                for($x = 1; $x < $max ; $x++) {
                    $length = $x > $middle ? $max - $x : $x;

                    $found = true;
                    for ($i = 0 ;$i<$max2;$i++) {
                        if($axe == 'x'){
                            $line = implode($mirror[$i]);
                            $left = substr($line, 0, $x);
                            $right = (substr($line, $x));

                            if($mirror_x < ($x-$length) || $mirror_x > ($x+$length)-1){
                                $found = false;
                                continue;
                            }

                        }
                        else{
                            $line = implode(array_column($mirror, $i));
                            $left = substr($line, 0, $x);
                            $right = (substr($line, $x));

                            if($mirror_y < ($x-$length) || $mirror_y > ($x+$length)-1){
                                $found = false;
                                continue;
                            }
                        }

                        $left = substr($left, $length * -1);
                        $right = strrev(substr($right, 0, $length));

                        if($left != $right){
                            $found = false;
                            break;
                        }
                    }
                    if($found){
                        $reflections[$axe][$mirror_index] = $x;
                        // echo "$mirror_index - $mirror_x,$mirror_y - $axe - $x\n";
                        break 4;
                    }
                }
            }
        }
    }
}
$result = array_sum($reflections['x']) + (100 * array_sum($reflections['y']));

echo "Solution : '$result'";