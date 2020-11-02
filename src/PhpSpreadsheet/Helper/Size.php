<?php

namespace PhpOffice\PhpSpreadsheet\Helper;

class Size
{
    const REGEXP_SIZE_VALIDATION = '/^(?P<size>\d*\.?\d+)(?P<unit>pt|px|em)?$/i';

    protected $valid;

    protected $size = '';

    protected $unit = '';

    public function __construct(string $size)
    {
        $this->valid = preg_match(self::REGEXP_SIZE_VALIDATION, $size, $matches);
        if ($this->valid) {
            $this->size = $matches['size'];
            $this->unit = $matches['unit'] ?? 'pt';
        }
    }

    public function valid(): bool
    {
        return $this->valid;
    }

    public function size(): string
    {
        return $this->size;
    }

    public function unit(): string
    {
        return $this->unit;
    }

    public function __toString()
    {
        return $this->size . $this->unit;
    }
}
