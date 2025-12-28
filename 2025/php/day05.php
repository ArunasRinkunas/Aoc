<?php

$file = file("inputs/day05.txt");

if ($file) {
    $ingredientsInRanges = [];
    
    [$ranges, $ingredientIds] = splitFileIntoRangesAndingredientIds($file);

    foreach ($ingredientIds as $ingredientId) {
        foreach ($ranges as $range) {
            [$min, $max] = explode('-', $range);

            if (
                ($min <= $ingredientId)
                && ($ingredientId <= $max)
                && !in_array($ingredientId, $ingredientsInRanges)
            ) {
                $ingredientsInRanges[] = $ingredientId;
            }
        }
    }

    print_r("Sum: " . count($ingredientsInRanges));
}

function splitFileIntoRangesAndingredientIds($file): array
{
    $wasThereAnEmptyLine = false;
    $ranges = [];
    $ingredientIds = [];

    foreach ($file as $line) {
        $line = rtrim($line);
        
        if (empty($line)) {
            $wasThereAnEmptyLine = true;

            continue;
        }

        if ($wasThereAnEmptyLine ) {
            $ingredientIds[] = $line;

            continue;
        }

        $ranges[] = $line;
    }
   
    return [$ranges, $ingredientIds];
}