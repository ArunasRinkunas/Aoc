<?php

$file = fopen("inputs/day03.txt", "r");

if ($file) {
    $digitsLength = 12;
    $highestJoltages = [];

    while (($line = fgets($file)) !== false) {
        $line = rtrim($line);

        $numbers = str_split($line);
        $numberCount = count($numbers);

        $maximumJoltage = [];
        for ($i = 0; $i < $numberCount; $i++) {
            $number = $numbers[$i];
            $remainingNumbers = $numberCount - $i;

            while (
                !empty($maximumJoltage) &&
                $maximumJoltage[count($maximumJoltage) - 1] < $number &&
                (count($maximumJoltage) - 1 + $remainingNumbers) >= $digitsLength
            ) {
                array_pop($maximumJoltage);
            }

            if (count($maximumJoltage) < $digitsLength) {
                $maximumJoltage[] = $number;
            }
        }

        $highestJoltages[] = implode('', $maximumJoltage);
    }

    print_r("Sum of all highest joltages: " . array_sum($highestJoltages));
    fclose($file);
}