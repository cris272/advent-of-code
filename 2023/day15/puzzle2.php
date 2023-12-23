<?php
$line = file_get_contents('input');
$strings = explode(',', $line);
$boxes = [];

foreach($strings as $string) {
    $type = false;

    if(strpos($string, '=')){
        $type = '=';
    }
    elseif(strpos($string, '-')){
        $type = '-';
    }
    else{
        var_dump($string);
        die('ko');
    }

    $parts = explode($type, $string);
    
    $label = $parts[0];
    $focal = $parts[1] ?? null;
    $lens = new Lens($label, $focal);
    $box_number = hashmap($label);
    $box = isset($boxes[$box_number]) ? $boxes[$box_number]:new Box();

    $boxes[$box_number] = $box;

    if($type == '-') {
        $box->remove($lens);
    }
    else{
        $box->add($lens);
    }


}

$result = 0;
ksort($boxes);
foreach ($boxes as $box_number => $value) {
    if(count($value->lenses) == 0)
        continue;
    // echo "\nBox $box_number : \n";
    $lens_number = 1;
    foreach ($value->lenses as $key2 => $lens) {
        $lens_power = (1 + $box_number) * $lens_number * $lens->focal;

        // echo "Lens $key2 : $lens->label - $lens->focal - $lens_power\n";
        $result += $lens_power;
        $lens_number++;
    }
}

echo "Solution : '$result'";


function hashmap($string): int{
    $result = 0;    
    
    $current_value = 0;
    for($i=0;$i<strlen($string);$i++){
        $char = $string[$i];
        $current_value += ord($char);
        $current_value *= 17;
        $current_value = $current_value % 256;
    }
    $result += $current_value;

    return $current_value;
}

class Box {
    public array $lenses = [];


    public function find_lens(Lens $lens_to_find){
        foreach ($this->lenses as $key => $lens) {
            if($lens->label == $lens_to_find->label){
                return $key;
            }
        }
        return false;
    }
    
    public function remove(Lens $lens_to_remove){
        $key = $this->find_lens($lens_to_remove);
        if($key !== false){
            unset($this->lenses[$key]);
        }
    }

    public function add(Lens $lens_to_add){

        $key = $this->find_lens($lens_to_add);
        if($key !== false){
            $this->lenses[$key] = $lens_to_add;
        }
        else{
            $this->lenses[] = $lens_to_add;
        }
    }
}

class Lens {
    public string $label;
    public ?string $focal;

    public function __construct($label, $focal){
        $this->label = $label;
        $this->focal = $focal;
    }
}