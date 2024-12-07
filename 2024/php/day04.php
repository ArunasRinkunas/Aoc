<?php

$program = new searchWord();

print_r('The answer is: ' . $program->startProgram());

class searchWord
{
    private const XMAS = ['X', 'M', 'A', 'S',];
    private const DIRECTION_KEYS = [
        'U', //UP
        'D', //DOWN
        'L', //LEFT
        'R', //RIGHT
        'RU', // UP RIGHT
        'RD', //DOWN RIGHT
        'LU', //UP LEFT
        'LD', //DOWN LEFT
    ];

    public function startProgram(): int
    {
        $input = $this->getInput();

        return $this->findCountOfWordXmas($input);;
    }

    private function getInput(): array
    {
        $file = fopen('inputs/day04.txt', 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $lines[] = str_split(trim($line));
            }
        }

        fclose($file);
        
        return $lines;
    }

    private function findCountOfWordXmas(array $input): int
    {
        $count = 0;
        $currentStepCount = 1;

        for ($row = 0; $row <= count($input) - 1 ; $row++) {
            for ($column = 0; $column <= count($input[$row]) - 1; $column++) {
                $currentLetter = $input[$row][$column];

                if ($currentLetter === self::XMAS[0]) {
                    foreach (self::DIRECTION_KEYS as $direction) {
                        [$newRow, $newColumn] = $this->getDirectionToCheck($direction, $row, $column);
                        if ($this->moveToDirectionUntilFoundWord($input, $direction, $newRow, $newColumn, $currentStepCount)) {
                            $count++;
                        }
                    }
                }
            }
        }

        return $count;
    }

    private function moveToDirectionUntilFoundWord($input, $direction, $row, $column, $currentStepCount): bool
    {
        //If found all letters return true;
        if ($currentStepCount >= count(self::XMAS)) {
            return true;
        }

        //If row gets out of bound return false;
        if ($row < 0 || $row >= count($input)) {
            return false;
        }
        
        //If column gets out of bound return false;
        if ($column < 0 || $column >= count($input[$row])) {
            return false;
        }

        //If next letter was found do recursion to find the rest of letters
        if ($input[$row][$column] === self::XMAS[$currentStepCount]) {
            [$newRow, $newColumn] = $this->getDirectionToCheck($direction, $row, $column);
            return $this->moveToDirectionUntilFoundWord($input, $direction, $newRow, $newColumn, $currentStepCount + 1);
        }
        
        return false;
        
    }

    private function getDirectionToCheck($direction, $row, $column): array
    {
        return match ($direction) {
            'U' => [$row - 1, $column], //UP
            'D' => [$row + 1, $column], //DOWN
            'L' => [$row, $column - 1], //LEFT
            'R' => [$row, $column + 1], //RIGHT
            'RU' => [$row - 1, $column + 1], // UP RIGHT
            'RD' => [$row + 1, $column + 1], //DOWN RIGHT
            'LU' => [$row - 1, $column - 1], //UP LEFT
            'LD' => [$row +1, $column - 1], //DOWN LEFT
        };
    }
}
