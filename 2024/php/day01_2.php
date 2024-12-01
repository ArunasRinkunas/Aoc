<?php

$numbers = file_get_contents('inputs/day01.txt');
$file = fopen("inputs/day01.txt", "r");
if ($file) {
    $sum = [];

    while (($line = fgets($file)) !== false) {
        $numbers = explode(' ', $line);
        $leftGroup[] = $numbers[0];
        $rightGroup[] = $numbers[3];
    }
    
    foreach ($leftGroup as $leftNumber) {
        $count = 0;
        foreach ($rightGroup as $rightNumber) {
            if ($leftNumber == $rightNumber) {
                $count++;
            }
        }
        if ($count > 0) {
            $sum[] = $leftNumber * $count;
        }
    }

    print_r("The sum is: " . array_sum($sum));
    fclose($file);
}