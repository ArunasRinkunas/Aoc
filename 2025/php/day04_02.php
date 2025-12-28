<?php

$file = file("inputs/day04.txt");

if ($file) {
    $sum = 0;

    while (true) {
        $toPick = [];

        foreach ($file as $lIndex => $line) {
            $lline = str_split(rtrim($line));

            foreach ($lline as $sIndex => $symbol) {
                if ($symbol === '@') {                    
                    $previousRow = $file[$lIndex - 1] ?? '';
                    $currentRow  = $file[$lIndex];
                    $nextRow     = $file[$lIndex + 1] ?? '';

                    $adjacentSymbols = getAllAdjacentSymbols(
                        [$previousRow, $currentRow, $nextRow],
                        $sIndex
                    );

                    if (doesCurrentRollCanBeReached($adjacentSymbols)) {
                        $toPick[] = [$lIndex, $sIndex];
                    }
                }
            }
        }

        if (empty($toPick)) {
            break;
        }

        $file = pickRolls($toPick, $file);

        $sum += count($toPick);
    }

    echo "Sum: $sum";
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

function pickRolls($toPick, $file): array
{
    foreach ($toPick as [$line, $symbol]) {
        $chars = str_split($file[$line]);
        $chars[$symbol] = '.';
        $file[$line] = implode('', $chars);
    }

    return $file;
}