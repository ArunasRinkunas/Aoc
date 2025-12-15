<?php

$file = fopen("inputs/day03.txt", "r");

if ($file) {
    $sumOfJolatages = 0;
    $highestJoltages = [];

    while (($line = fgets($file)) !== false) {
        $line = rtrim($line);
        // print_r($line . '<br>');
        $numbers = str_split($line);
        // print_r(count($numbers) . '<br>');
        $clonedNumbers = $numbers;
        array_pop($clonedNumbers);

        // foreach ($clonedNumbers as $index => $slice) {
        //     print_r('index: ' . $index . ' number: ' . $slice . '<br>');
        // }
        
        $firstBiggestNumber = max($clonedNumbers);
        // print_r('first biggest number: '. $firstBiggestNumber . '<br>');
        $firstBiggestNumberIndex = array_search($firstBiggestNumber, $clonedNumbers);
        // print_r('first biggest number index: '. $firstBiggestNumberIndex . '<br>');

        $sliceArrayFromBiggestNumberIndex = array_slice($numbers, $firstBiggestNumberIndex + 1, null, true);
        // print_r('the rest of array after slice: ' . '<br>');
        
        // foreach ($sliceArrayFromBiggestNumberIndex as $index => $slice) {
        //     print_r('index: ' . $index . ' number: ' . $slice . '<br>');
        // }

        $secondBiggestNumber = max($sliceArrayFromBiggestNumberIndex);
        $secondBiggestNumberIndex = array_search($secondBiggestNumber, $numbers);
        // print_r('first biggest number: '. $secondBiggestNumber . '<br>');
        // print_r('first biggest number index: '.$secondBiggestNumberIndex . '<br>');

        // print_r('largest joltage possible: ' . $firstBiggestNumber . $secondBiggestNumber . '<hr>' . '<br>');
        $highestJoltages[] = (int) ($firstBiggestNumber . $secondBiggestNumber);
        
        // die;
        // foreach ($numbers as $index => $number) {
        //     print_r('index: ' . $index . ' number: ' . $number . '<br>');
        //     die;
        // }
        // die;
    }

    // print_r($highestJoltages);
    print_r("Sum of all highest joltages: " . array_sum($highestJoltages));
    fclose($file);
}