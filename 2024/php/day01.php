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
    
    while (count($leftGroup) > 0 && count($rightGroup) > 0) {
        $minNumberInLeftGroup = min($leftGroup);
        $minNumberInRightGroup = min($rightGroup);
        $indexOfMinNumberInLeftGroup = array_search($minNumberInLeftGroup,$leftGroup);
        $indexOfMinNumberInRightGroup = array_search($minNumberInRightGroup,$rightGroup);
        
        $sum[] = abs($minNumberInLeftGroup - $minNumberInRightGroup);
        unset($leftGroup[$indexOfMinNumberInLeftGroup]);
        unset($rightGroup[$indexOfMinNumberInRightGroup]);
    }
    
    print_r("The sum is: " . array_sum($sum));
    fclose($file);
}