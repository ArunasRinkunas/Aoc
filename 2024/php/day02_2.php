<?php

function getFromFileReports() {
    $reports = [];
    $file = fopen("inputs/day02.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $numbers = explode(' ', $line);
            $reports[] = $numbers;
        }
    }

    return $reports;
}

$reports = getFromFileReports();
$countValidReports = 0;
foreach ($reports as $report) {
    if (validateReportByCheckingEveryIndexRemoved($report)) {
        $countValidReports++;
    }
}

print_r('Sum of valid reports: ' . $countValidReports);

function validateReport(array $report): bool
{
    $isIncreasing = areNumbersIncreasing($report);
    $isDecreasing = areNumbersDecreasing($report);
    if ($isIncreasing === $isDecreasing) {
        return false;
    }

    $previousNumber = null;
    foreach ($report as $number) {
        if (is_null($previousNumber)) {
            $previousNumber = $number;

            continue;
        }

        $validNumber = validateNumber(
            $number, 
            $previousNumber, 
            $isIncreasing, 
            $isDecreasing
        );

        if (!$validNumber) {
            return false;
        }

        $previousNumber = $number;
    }

    return true;
}

function areNumbersIncreasing(array $report): bool
{
    $sortedReport = $report;
    sort($report, SORT_NUMERIC);
    
    return $sortedReport === $report;
}

function areNumbersDecreasing(array $report): bool
{
    $sortedReport = $report;
    sort($report, SORT_NUMERIC);

    return $sortedReport === array_reverse($report);
}

function validateNumber(int $number, int $previousNumber, bool $isIncreasing, bool $isDecreasing): bool
{
    if (abs($number - $previousNumber) > 3 || $number === $previousNumber) {
        return false;
    }

    if ($number > $previousNumber && $isDecreasing) {
        return false;
    }

    if ($number < $previousNumber && $isIncreasing) {
        return false;
    }

    return true;
}

function arrayWithoutIndex(array $input, int $index): array
{
    unset($input[$index]);

    return array_values($input);
}

function validateReportByCheckingEveryIndexRemoved(array $report): bool {
    // for ($i = 0; $i < count($report); $i++) {
    //     if (validateReport(arrayWithoutIndex($report, $i))) {
    //         return true;
    //     }
    // }
    // return false;

     return array_any(
        $report,
        fn ($value, $index) => validateReport(arrayWithoutIndex($report, $index))
     );
}