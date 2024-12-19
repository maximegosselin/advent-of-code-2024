<?php

declare(strict_types=1);

[$left, $right] = [[], []];
$f = fopen('input.txt', 'r');
while (($line = fgets($f)) !== false) {
    [$left[], $right[]] = sscanf($line, '%i %i');
}
fclose($f);
sort($left);
sort($right);

$total = 0;
for ($i = 0; $i < count($left); $i++) {
    $total += abs($left[$i] - $right[$i]);
}

echo $total . PHP_EOL;