<?php

$file = file("inputs/day06.txt");

if ($file) {
    $lines = getEveryLine($file);
    $operators = str_split(str_replace(' ', '', array_pop($lines)));
    $columns = [];
    $newLines = [];

    foreach ($lines as $line) {
        $line = array_filter(explode(' ', $line));
        $newLines[] = $line;
    }
    $columns = array_map(null, ...$newLines);

    $sum = 0;
    foreach ($operators as $index => $operator) {
        $numbers = array_filter($columns[$index]);
        if ('+' === $operator) {
            $sum += array_sum($numbers);
        } else if ('*' === $operator) {
            $sum += array_product($numbers);
        }
    }

    print_r('<br><hr>Sum: ' . $sum);
}


function getEveryLine($file): array
{
    $lines = [];

    foreach ($file as $line) {
        $line = rtrim($line);

        $lines[] = $line;
    }
   
    return $lines;
}
