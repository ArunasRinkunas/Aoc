<?php

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
                // if it goes below 0 then we do 99
                if ($i === -1) {
                    $i = 99;
                }
                $currentLockNumberIndex = $i;
            }

            if ($currentLockNumberIndex === 0) {
                $currentLockNumberIndex = 0;
                $sumPointedAtZero++;
            }
        } elseif ('R' === $turningTo) {
            for($i = $currentLockNumberIndex; $number >= 0; $i++) {
                $number = $number - 1;
                //if it goes over 99 then we do 0
                if ($i === 100) {
                    $i = 0;
                }
                $currentLockNumberIndex = $i;
            }
            if ($currentLockNumberIndex === 0) {
                $currentLockNumberIndex = 0;
                $sumPointedAtZero++;
            }
        }
    }
    
    print_r("the dial points at 0 a total of " . $sumPointedAtZero);
    fclose($file);
}