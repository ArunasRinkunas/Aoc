<?php

print_r('The answer is: ' . startProgram());

function startProgram(): int
{
    preg_match_all('/mul\(([0-9]*[,][0-9]*)\)/', getCorruptedMemory(), $matches, PREG_UNMATCHED_AS_NULL);

    return calculateMultiplications($matches);
}

function getCorruptedMemory() {
    return file_get_contents("inputs/day03.txt");
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
