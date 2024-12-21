<?php

declare(strict_types=1);

namespace AdventOfCode2024;

class Day3
{
    private const string DO_COMMAND = "do()";

    private const string DONT_COMMAND = "don't()";

    private bool $mulEnabled = true;

    private int $sumOfEnabledMultiplications = 0;

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

        echo sprintf('Sum of multiplications: %d', $this->sumOfEnabledMultiplications) . PHP_EOL;
    }

    private function mulParser(string $char): void
    {
        if (!$this->mulEnabled) {
            return;
        }
        $this->mulParserBuffer .= $char;
        if (preg_match('/^m?u?l?\(?(\d{1,3})?,?(\d{1,3})?\)?$/', $this->mulParserBuffer) !== 1) {
            $this->mulParserBuffer = '';
        } elseif (preg_match('/^mul\(\d{1,3},\d{1,3}\)$/', $this->mulParserBuffer) === 1) {
            $this->sumOfEnabledMultiplications += array_product(sscanf($this->mulParserBuffer, 'mul(%d,%d)'));
            $this->mulParserBuffer = '';
        }
    }

    private function doParser(string $char): void
    {
        if ($this->mulEnabled) {
            return;
        }
        $this->doParserBuffer .= $char;
        if ($this->doParserBuffer === self::DO_COMMAND) {
            $this->mulEnabled = true;
            $this->doParserBuffer = '';
        } elseif (!str_starts_with(self::DO_COMMAND, $this->doParserBuffer)) {
            $this->doParserBuffer = '';
        }
    }

    private function dontParser(string $char): void
    {
        if (!$this->mulEnabled) {
            return;
        }
        $this->dontParserBuffer .= $char;
        if ($this->dontParserBuffer === self::DONT_COMMAND) {
            $this->mulEnabled = false;
            $this->dontParserBuffer = '';
        } elseif (!str_starts_with(self::DONT_COMMAND, $this->dontParserBuffer)) {
            $this->dontParserBuffer = '';
        }
    }
}
