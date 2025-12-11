<?php

$numbers = file_get_contents('inputs/day01.txt');
$file = fopen("inputs/day01.txt", "r");

if ($file) {
    $sumPointedAtZero = 0;
    $safeLock = range(0, 99);
    $currentLockNumberIndex = 50;

    while (($line = fgets($file)) !== false) {
        $line = trim($line);
        if ($line === '') continue;

        $turningTo = $line[0];
        $number = intval(substr($line, 1));

        $i = $currentLockNumberIndex;
        for ($step = 0; $step < $number; $step++) {
            //passes zero when turning
            if ($turningTo === 'L') {
                $i--;
                if ($i < 0) {
                    $i = 99;
                }
            } elseif ($turningTo === 'R') {
                $i++;
                if ($i > 99) {
                    $i = 0;
                } 
            }
            
            //hits zero exactly
            if ($i === 0) {
                $sumPointedAtZero++;
            }
        }

        $currentLockNumberIndex = $i;
    }
    
    print_r("<br><hr>the dial points at 0 a total of " . $sumPointedAtZero);
    fclose($file);
}