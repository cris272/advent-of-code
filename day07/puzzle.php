<?php
$input = fopen(__DIR__."/input", "r");

$solution = 0;
$current_path = [];
$default_directory = ['size' => 0, 'total_size' => 0, 'tree' => []];
$tree = ['/' => $default_directory];
$current = false;
while(!feof($input)) {
    $line = trim(fgets($input), "\n");

    if(preg_match('#^\$ (cd|ls)( (.*))?$#', $line, $m)) {
        if($m[1] == 'cd') {
            if($m[3] == '..'){
                unset($current_path[array_key_last($current_path)]);

            }
            elseif($m[3] == '/'){
                $current_path = ['/'];
            }
            else{
                $current_path[] = $m[3];
            }
        }
        elseif($m[1] == 'ls') {
            $current = &$tree['/'];
            foreach($current_path as $dir) {
                if($dir == '/')
                    continue;
                $current = &$current['tree'][$dir];
            }
        }
    }
    if(preg_match('#([0-9]+) (.*)#', $line, $m)) {
        $current['size'] += $m[1];
    }
    elseif(preg_match('#dir (.*)#', $line, $m)) {
        $current['tree'][$m[1]] = $default_directory;
    }
}

sum2($tree['/']);
print_r($tree);
sum3($tree['/']);
echo "Solution : '$solution'";


function sum2(&$dirs) {
    $dirs['total_size'] = $dirs['size'];
    foreach ($dirs['tree'] as &$dir) {
        $dirs['total_size'] += sum2($dir);
    }
    return $dirs['total_size'];
}

function sum3(&$dirs) {
    global $solution;
    foreach ($dirs['tree'] as $dir) {
        sum3($dir); 
    }

    if($dirs['total_size'] <= 100000)
        $solution += $dirs['total_size'];
}

?>

