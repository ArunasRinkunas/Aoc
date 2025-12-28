<?php

$file = file("inputs/day05.txt");

if ($file) {
    $ranges = splitFileIntoRanges($file);

    $freshCount = countFreshIds($ranges);

    echo $freshCount;
}


function splitFileIntoRanges($file): array
{
    $ranges = [];

    foreach ($file as $line) {
        $line = rtrim($line);
        
        if (empty($line)) {

            break;
        }

        $ranges[] = $line;
    }
   
    return $ranges;
}

function countFreshIds(array $ranges): int
{
    //Ranges where they start being active and not. 
    //1 is start of range being active. -1 range is over, numbers won't be valid later
    $events = [];

    foreach ($ranges as $range) {
        [$min, $max] = explode('-', $range);

        $events[$min] = ($events[$min] ?? 0) + 1;
        $events[$max + 1] = ($events[$max + 1] ?? 0) - 1;
    }

    ksort($events);

    $nowActiveRanges = 0;
    $lastPos = null;
    $total = 0;

    foreach ($events as $pos => $isActive) {
        if ($nowActiveRanges > 0 && $lastPos !== null) {
            $total += ($pos - $lastPos);
        }

        //this will do + (1) or + (-1), that's how it will know if there is active range or not
        $nowActiveRanges += $isActive;
        $lastPos = $pos;
    }

    return $total;
}
