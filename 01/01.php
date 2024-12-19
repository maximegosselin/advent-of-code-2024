<?php

declare(strict_types=1);

[$left, $right] = [[], []];
$f = fopen('input.txt', 'r');
while (($line = fgets($f)) !== false) {
    [$left[], $right[]] = sscanf($line, '%d %d');
}
fclose($f);
sort($left);
sort($right);

$totalDistance = 0;
$similarityScore = 0;
for ($i = 0; $i < count($left); $i++) {
    $totalDistance += abs($left[$i] - $right[$i]);
    $similarityScore += ($left[$i] * count(array_filter($right, fn($id) => $id === $left[$i])));
}

echo sprintf('Total distance: %d', $totalDistance) . PHP_EOL;
echo sprintf('Similarity score: %d', $similarityScore) . PHP_EOL;