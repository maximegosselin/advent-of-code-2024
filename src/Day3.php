<?php

declare(strict_types=1);

namespace AdventOfCode2024;

class Day3
{
    private bool $mulEnabled = true;

    private array $mulOperations = [];

    private $mulParserBuffer = '';

    private $doParserBuffer = '';

    private $dontParserBuffer = '';

    public function __invoke(): void
    {
        $f = fopen('input.txt', 'r');
        while (($char = fgetc($f)) !== false) {
            $this->doParser($char);
            $this->dontParser($char);
            $this->mulParser($char);
        }
        fclose($f);
    }

    private function mulParser(string $char): void
    {
        $this->mulParserBuffer .= $char;
    }

    private function doParser(string $char): void
    {
    }

    private function dontParser(string $char): void
    {
    }
}
