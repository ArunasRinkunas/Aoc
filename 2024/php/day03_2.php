<?php

print_r('The answer is: ' . startProgram());

function startProgram(): int
{
    $corruptedMemory = deleteEverythingBetweenDontAndDo(getCorruptedMemory());

    preg_match_all('/mul\(([0-9]*[,][0-9]*)\)/', $corruptedMemory, $matches, PREG_UNMATCHED_AS_NULL);

    return calculateMultiplications($matches);
}

function getCorruptedMemory() {
    return file_get_contents("inputs/day03.txt");
}

function deleteEverythingBetweenDontAndDo(string $corruptedMemory): string
{
    preg_match_all('/don\'t\(\)(?:.|\n)*?do\(\)/', $corruptedMemory, $deleteMatches, PREG_UNMATCHED_AS_NULL);

    foreach ($deleteMatches[0] as $deleteMatch) {
        $corruptedMemory = str_replace($deleteMatch, '', $corruptedMemory);
    }

    return $corruptedMemory;
}

function calculateMultiplications(array $matches): int
{
    $multipliedNumbers = [];

    foreach ($matches[1] as $multiplications) {
        $explodedMultiplication = explode(',', $multiplications);
        $multipliedNumbers[] = $explodedMultiplication[0] * $explodedMultiplication[1];
    }

    return array_sum($multipliedNumbers);
}
