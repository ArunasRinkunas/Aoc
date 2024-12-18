<?php
$program = new searchWord();

print_r('The answer is: ' . $program->startProgram());

class searchWord
{
    private const MAS = ['M', 'A', 'S',];

    public function startProgram(): int
    {
        $input = $this->getInput();

        return $this->findCountOfWordMas($input);;
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

    private function findCountOfWordMas(array $input): int
    {
        $count = 0;

        for ($row = 0; $row <= count($input) - 1 ; $row++) {
            for ($column = 0; $column <= count($input[$row]) - 1; $column++) {
                $currentLetter = $input[$row][$column];

                if ($currentLetter === self::MAS[1]) {
                    if ($row-1 < 0 || $row+1 >= count($input)) {
                        continue 2;
                    }

                    if ($column-1 < 0 || $column+1 >= count($input[$row])) {
                        continue;
                    }

                    if ($this->checkCorners($input, $row, $column)) {
                        $count++;
                    }
                }
            }
        }

        return $count;
    }

    private function checkCorners($input, $row, $column): bool
    {
        $firstCrossValid = false;
        $secondCrossValid = false;

        $topLeftCorner = $input[$row-1][$column-1];
        $topRightCorner = $input[$row-1][$column+1];
        $bottomLeftCorner = $input[$row+1][$column-1];
        $bottomRightCorner = $input[$row+1][$column+1];
        
        $crossOne = [$topLeftCorner, $bottomRightCorner];
        $crossTwo = [$topRightCorner, $bottomLeftCorner];

        if (
            in_array('M', $crossOne)
            && in_array('S', $crossOne)
        ) {
            $firstCrossValid = true;
        }

        if (
            in_array('M', $crossTwo)
            && in_array('S', $crossTwo)
        ) {
            $secondCrossValid = true;
        }

        return $firstCrossValid && $secondCrossValid;
    }
}
