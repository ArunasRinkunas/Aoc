<?php

$file = fopen("inputs/day02.txt", "r");

if ($file) {
    $sumOfBadIds = 0;
    while (($line = fgets($file)) !== false) {
        foreach (explode(',',$line) as $idRange) {
            [$startId, $endId] = explode('-', $idRange);
            foreach (range($startId, $endId) as $number) {
                preg_match('/^(\d+)\1+$/', $number, $matches);
                if (!empty($matches)) {
                    $sumOfBadIds += $matches[0];
                }
            }
        }
    }
    
    print_r("Sum of all bad id numbers are " . $sumOfBadIds);
    fclose($file);
}