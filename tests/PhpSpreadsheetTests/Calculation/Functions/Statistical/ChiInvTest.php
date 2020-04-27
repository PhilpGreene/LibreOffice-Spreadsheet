<?php

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\Statistical;

use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical;
use PHPUnit\Framework\TestCase;

class ChiInvTest extends TestCase
{
    protected function setUp(): void
    {
        Functions::setCompatibilityMode(Functions::COMPATIBILITY_EXCEL);
    }

    /**
     * @dataProvider providerCHIINV
     *
     * @param mixed $expectedResult
     */
    public function testCHIINV($expectedResult, ...$args)
    {
        $result = Statistical::CHIINV(...$args);
        $this->assertEqualsWithDelta($expectedResult, $result, 1E-12);
    }

    public function providerCHIINV()
    {
        return require 'data/Calculation/Statistical/CHIINV.php';
    }
}
