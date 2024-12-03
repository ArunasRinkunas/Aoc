<?php

function getCorruptedMemory() {
    return file_get_contents("inputs/day03.txt");
}

$corruptedMemory = getCorruptedMemory();

$multipliedNumbers = [];
$corruptedMemory = deleteEverythingBetweenDontAndDo($corruptedMemory);

preg_match_all('/mul\(([0-9]*[,][0-9]*)\)/', $corruptedMemory, $matches, PREG_UNMATCHED_AS_NULL);

foreach ($matches[1] as $multiplications) {
    $explodedMultiplication = explode(',', $multiplications);
    $multipliedNumbers[] = $explodedMultiplication[0] * $explodedMultiplication[1];
}

print_r(array_sum($multipliedNumbers));

function deleteEverythingBetweenDontAndDo($corruptedMemory) {
    preg_match_all('/don\'t\(\)(?:.|\n)*?do\(\)/', $corruptedMemory, $deleteMatches, PREG_UNMATCHED_AS_NULL);

    foreach ($deleteMatches[0] as $deleteMatch) {
        $corruptedMemory = str_replace($deleteMatch, '', $corruptedMemory);
    }

    return $corruptedMemory;
}
