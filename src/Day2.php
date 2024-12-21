<?php

declare(strict_types=1);

namespace AdventOfCode2024;

class Day2
{
    public function __invoke(): void
    {
        $valid = 0;
        $f = fopen('input.txt', 'r');
        while (($line = fgets($f)) !== false) {
            $numbers = array_map('intval', explode(' ', $line));
            if ($this->numbersAreIncreasingOrDecreasing(...$numbers)
                && $this->numbersRespectAdjacentDistance(...$numbers)) {
                $valid++;
            }
        }
        fclose($f);

        echo sprintf('Valid reports: %d', $valid) . PHP_EOL;
    }

    private function numbersAreIncreasingOrDecreasing(int ...$numbers): bool
    {
        [$ascSorted, $descSorted] = [$numbers, $numbers];
        sort($ascSorted);
        rsort($descSorted);
        return ($ascSorted === $numbers) || ($descSorted === $numbers);
    }

    private function numbersRespectAdjacentDistance(int ...$numbers): bool
    {
        $valid = true;
        for ($i = 0; $i < count($numbers); $i++) {
            if (!$valid || ($i === count($numbers) - 1)) {
                break;
            }
            $distance = abs($numbers[$i] - $numbers[$i + 1]);
            $valid = $valid && ($distance >= 1) && ($distance <= 3);
        }
        return $valid;
    }
}
