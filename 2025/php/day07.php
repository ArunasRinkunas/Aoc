<?php

$file = file("inputs/day07.txt");

if ($file) {
    $lines = getEveryLine($file);

    $beamSplitted = 0;
    $beamIndex = [];
    foreach ($lines as $lineIndex => $line) {
        foreach (str_split($line) as $index => $symbol) {
            if ('S' === $symbol) {
                $beamIndex[$index] = $index;

                break;
            }

            if ('^' === $symbol && in_array($index, $beamIndex)) {
                $beamSplitted++;
                
                unset($beamIndex[$index]);
                $beamIndex[$index + 1] = $index + 1;
                $beamIndex[$index - 1] = $index - 1;
                $beamIndex = array_unique($beamIndex);
            }

        }
    }

    print_r('<br>Beam splitted: ' . $beamSplitted . ' times');
}


function getEveryLine($file): array
{
    $lines = [];

    foreach ($file as $line) {
        $line = rtrim($line);

        $lines[] = $line;
    }
   
    return $lines;
}
