<?php

$file = fopen("inputs/day03.txt", "r");

if ($file) {
    $sumOfJolatages = 0;
    $highestJoltages = [];

    while (($line = fgets($file)) !== false) {
        //trim line, because it takes \n later on
        $line = rtrim($line);
        $numbers = str_split($line);
        //First we want to find highest number without the last one digit
        $clonedNumbers = $numbers;
        array_pop($clonedNumbers);
        $firstBiggestNumber = max($clonedNumbers);
        $firstBiggestNumberIndex = array_search($firstBiggestNumber, $clonedNumbers);

        //We are removing highest found digit while leaving array keys intact
        $sliceArrayFromBiggestNumberIndex = array_slice($numbers, $firstBiggestNumberIndex + 1, null, true);

        //Now we want to use all digits to find second highest number
        $secondBiggestNumber = max($sliceArrayFromBiggestNumberIndex);
        $secondBiggestNumberIndex = array_search($secondBiggestNumber, $numbers);

        // We add the numbers and put them to array
        $highestJoltages[] = (int) ($firstBiggestNumber . $secondBiggestNumber);
    }

    print_r("Sum of all highest joltages: " . array_sum($highestJoltages));
    fclose($file);
}