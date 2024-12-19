<?php

declare(strict_types=1);

$m1 = memory_get_usage();

require 'vendor/autoload.php';

$crash = function (string $message): never {
    echo $message . PHP_EOL;
    exit(1);
};

$day = (int)($argv[1] ?? 1);
if ($day < 1 || $day > 24) {
    $crash('Day must be between 1 and 24.');
}

try {
    $fqcn = sprintf("\\AdventOfCode2024\\Day%d", $day);
    $program = new $fqcn();
} catch (Throwable) {
    $crash('Not coded yet!');
}

echo sprintf('ADVENT OF CODE 2024: DAY %d', $day) . PHP_EOL;
echo '---' . PHP_EOL;

$t1 = microtime(true);
$program();
$t2 = microtime(true);
$m2 = memory_get_peak_usage();

echo '---' . PHP_EOL;
echo sprintf('Took %s seconds with %d bytes of memory.', ($t2 - $t1), $m2 - $m1) . PHP_EOL;