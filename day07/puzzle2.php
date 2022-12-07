<?php
$input = fopen(__DIR__."/input", "r");

$solution = 99999999999;
$current_path = [];
$default_directory = ['size' => 0, 'total_size' => 0, 'tree' => []];
$tree = ['/' => $default_directory];
$current = false;
$total_space = 70000000;
$require_space = 30000000;
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

$free_space = $total_space - $tree['/']['total_size'];
$space_to_free = $require_space - $free_space;

echo "free_space : '$free_space'\n";
echo "space_to_free : '$space_to_free'\n";

find_dir($tree['/']);
echo "Solution : '$solution'\n";

function sum2(&$dirs) {
    $dirs['total_size'] = $dirs['size'];
    foreach ($dirs['tree'] as &$dir) {
        $dirs['total_size'] += sum2($dir);
    }
    return $dirs['total_size'];
}

function find_dir(&$dirs) {
    global $solution, $space_to_free;
    foreach ($dirs['tree'] as $dir) {
        find_dir($dir); 
    }

    if($dirs['total_size'] <= $solution && $dirs['total_size'] >= $space_to_free)
        $solution = $dirs['total_size'];
}

?>

