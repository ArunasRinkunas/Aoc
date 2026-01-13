<?php

$fileLines = file("inputs/day07.txt", FILE_IGNORE_NEW_LINES);
$rows = count($fileLines);
$cols = strlen($fileLines[0]);

// Find start position
foreach (str_split($fileLines[0]) as $column => $symbol) {
    if ($symbol === 'S') {
        $startCol = $column;

        break;
    }
}

$paths = [
    $startCol => 1
];

//Process each row below S
for ($row = 1; $row < $rows; $row++) {
    $nextPaths = [];

    foreach ($paths as $col => $count) {
        $symbol = $fileLines[$row][$col] ?? null;

        if ($symbol === '^') {
            if ($col > 0) {
                $nextPaths[$col - 1] = ($nextPaths[$col - 1] ?? 0) + $count;
            }
            if ($col < $cols - 1) {
                $nextPaths[$col + 1] = ($nextPaths[$col + 1] ?? 0) + $count;
            }
        } else {
            $nextPaths[$col] = ($nextPaths[$col] ?? 0) + $count;
        }
    }
    
    $paths = $nextPaths;
}

echo "Total timelines: " . array_sum($paths);
