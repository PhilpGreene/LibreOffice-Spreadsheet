<?php

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\DateTime;

use PhpOffice\PhpSpreadsheet\Calculation\DateTime;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    protected function setUp(): void
    {
        Functions::setCompatibilityMode(Functions::COMPATIBILITY_EXCEL);
        Functions::setReturnDateType(Functions::RETURNDATE_EXCEL);
        Date::setExcelCalendar(Date::CALENDAR_WINDOWS_1900);
    }

    /**
     * @dataProvider providerMONTH
     *
     * @param mixed $expectedResult
     * @param $dateTimeValue
     */
    public function testMONTH($expectedResult, $dateTimeValue)
    {
        $result = DateTime::MONTHOFYEAR($dateTimeValue);
        $this->assertEqualsWithDelta($expectedResult, $result, 1E-8);
    }

    public function providerMONTH()
    {
        return require 'tests/data/Calculation/DateTime/MONTH.php';
    }
}
