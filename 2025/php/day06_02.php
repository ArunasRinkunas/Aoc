<?php

$file = file("inputs/day06.txt");

if ($file) {
    $matrix = getEveryLine($file);
    $sum = 0;

    $maxCols = max(array_map('count', $matrix));
    $columns = columnsToArray($maxCols, $matrix);

    $operator = null;
    $portion = [];
    $lastColumnIndex = $maxCols - 1;
    foreach ($columns as $i => $col) {
        $gluedNumber = '';

        if (null === $operator) {
            $operator = array_pop($col);
        }
        
        if (!array_filter($col, fn($v) => trim($v) !== '')) {
            $sum = addToTheSum($operator, $portion, $sum);

            //We reset operator and potion of numbers
            //so that we could start a new portion with its' operator
            $operator = null;
            $portion = [];
        } else {
            $col = array_filter($col);
            foreach ($col as $number) {
                $gluedNumber .= $number;
            }

            $portion[] = $gluedNumber;
        }

    }
    
    //check if we have last portion of numbers and add them to sum
    if (!empty($portion) && null !== $operator) {
        $sum = addToTheSum($operator, $portion, $sum);
    }

    print_r('<br><hr>Sum: ' . $sum);
}


function getEveryLine($file): array
{
    $lines = [];

    foreach ($file as $line) {
        $lines[] = str_split(rtrim($line, "\r\n"));
    }
   
    return $lines;
}

function columnsToArray($maxCols, $matrix): array
{
    $columns = [];

    for ($col = 0; $col < $maxCols; $col++) {
        $columns[$col] = [];
        foreach ($matrix as $row) {
            $columns[$col][] = $row[$col] ?? '';
        }
    }

    return $columns;
}

function addToTheSum($operator, $portion, $sum): int 
{
    if ('+' === $operator) {
        $sum += array_sum($portion);
    } else if ('*' === $operator) {
        $sum += array_product($portion);
    }

    return $sum;
}
