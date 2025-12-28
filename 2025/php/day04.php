<?php

$file = file("inputs/day04.txt");

if ($file) {
    $sum = 0;

    foreach ($file as $lIndex => $line) {
        $lline = str_split(rtrim($line));

        foreach ($lline as $sIndex => $symbol) {
            if ($symbol === '@') {
                $previousRow = $file[$lIndex-1] ?? '';
                $currentRow = $file[$lIndex];
                $nextRow = $file[$lIndex+1] ?? '';

                $adjacentSymbols = getAllAdjacentSymbols(
                    [$previousRow, $currentRow, $nextRow],
                    $sIndex
                );
                
                if (doesCurrentRollCanBeReached($adjacentSymbols)) {
                    $sum++;
                    continue;
                }
            }
        }

    }

    print_r("Sum: " . $sum);
}

function getAllAdjacentSymbols(array $rows, int $sIndex): array
{
    $adjacentSymbols = [];

    foreach ($rows as $rowIndex => $row) {
        if ($row === '') {
            continue;
        }

        $row = str_split(rtrim($row));

        for ($i = $sIndex - 1; $i <= $sIndex + 1; $i++) {
            if ($rowIndex === 1 && $i === $sIndex) {
                continue; // skip center
            }
            $adjacentSymbols[] = $row[$i] ?? '.';
        }
    }

    return $adjacentSymbols;
}

function doesCurrentRollCanBeReached(array $adjacentSymbols): bool
{
    $countedValues = array_count_values($adjacentSymbols);

    $adjacent = $countedValues['@'] ?? 0;

    return 4 > $adjacent;
}