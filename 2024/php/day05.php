<?php
$program = new printQueue();

print_r('The answer is: ' . $program->startProgram());

class printQueue
{
    public function startProgram(): int
    {
        $input = $this->getInput();

        return $this->findTheSumOfValidQueuesMiddleNumber($input);;
    }

    private function getInput(): array
    {
        $rules = [];
        $pages = [];
        $file = fopen('inputs/day05.txt', 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                if ("" == trim($line)) {
                    continue;
                }

                if (str_contains($line, '|')) {
                    $rules[] = explode('|', $line);
                } else {
                    $pages[] = $line;
                }
            }
        }
        
        fclose($file);

        $lines['rules'] = $rules;
        $lines['pages'] = $pages;

        return $lines;
    }

    private function findTheSumOfValidQueuesMiddleNumber($input): int
    {
        $sum = 0;
        $rules = $input['rules'];
        $pages = $input['pages'];

        foreach ($pages as $pageNumbers) {
            $pageNumbers = explode(',', $pageNumbers);

            foreach ($rules as $rule) {
                if (!$this->validateRule($pageNumbers, $rule)) {
                    continue 2;
                }
            }

            $middeNumber = $pageNumbers[(int)(count($pageNumbers) / 2)];
            $sum += $middeNumber;
        }

        return $sum;
    }

    private function validateRule($pageNumbers, $rule): bool
    {
        $index1 = array_search($rule[0], $pageNumbers);
        $index2 = array_search($rule[1], $pageNumbers);

        if (false === $index1 || false === $index2) {
            return true;
        }

        if ($index1 < $index2) {
            return true;
        }
        
        return false;
    }
}
