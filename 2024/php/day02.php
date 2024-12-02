<?php

$file = fopen("inputs/day02.txt", "r");
if ($file) {
    $count = 0;
    $sum = 0;

    while (($line = fgets($file)) !== false) {
        $numbers = explode(' ', $line);
        if (isLineNumbersIncreasing($numbers) || isLineNumbersDecreasing($numbers)) {
            $count = checkIfNumberPairsDoNotExceed3($numbers);
        }

        $sum += $count;
    }

    print_r('Sum is: ' . $sum);
}

function isLineNumbersIncreasing(array $numbers): bool
{
    for ($i = 0; $i < count($numbers); $i++) {
        if (
            array_key_exists($i+1, $numbers)
            && $numbers[$i] >= $numbers[$i+1]
            
            ) {
            return false;
        }
    }

    return true;
}

function isLineNumbersDecreasing(array $numbers): bool
{
    for ($i = 0; $i < count($numbers); $i++) {
        if (
            array_key_exists($i+1, $numbers)
            && $numbers[$i] <= $numbers[$i+1]
            
            ) {
            return false;
        }
    }

    return true;
}

function checkIfNumberPairsDoNotExceed3(array $numbers): int
{
    for ($i = 0; $i <= count($numbers); $i++) {
        if (
            array_key_exists($i+1, $numbers) 
            && (
                abs($numbers[$i] - $numbers[$i+1]) > 3
            )
        )
        {
            return 0;
        }
    }

    return 1;
}