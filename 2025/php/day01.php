<?php

$numbers = file_get_contents('inputs/day01.txt');
$file = fopen("inputs/day01.txt", "r");

if ($file) {
    $sumPointedAtZero = 0;
    $safeLock = range(0, 99);
    $currentLockNumberIndex = 50;

    while (($line = fgets($file)) !== false) {
        $turningTo = str_split($line, 1)[0];
        $number = substr($line, 1);
        if ('L' === $turningTo) {
            for($i = $currentLockNumberIndex; $number >= 0; $i--) {
                $number = $number - 1;
                $currentLockNumberIndex = $i;
                if ($i === 0) {
                    $i = 100;
                }
            }
            PHP_EOL;
            if ($currentLockNumberIndex === 100 || $currentLockNumberIndex === 0) {
                $currentLockNumberIndex = 0;
                $sumPointedAtZero++;
            }
        } elseif ('R' === $turningTo) {
            for($i = $currentLockNumberIndex; $number >= 0; $i++) {
                $number = $number - 1;
                $currentLockNumberIndex = $i;
                if ($i === 100) {
                    $i = 0;
                }
            }
            if ($currentLockNumberIndex === 100 || $currentLockNumberIndex === 0) {
                $currentLockNumberIndex = 0;
                $sumPointedAtZero++;
            }
        }
    }
    
    print_r("the dial points at 0 a total of " . $sumPointedAtZero);
    fclose($file);
}