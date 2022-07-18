<?php

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\TextData;

class TextBeforeTest extends AllSetupTeardown
{
    /**
     * @dataProvider providerTEXTBEFORE
     */
    public function testTextBefore(string $expectedResult, array $arguments): void
    {
        $text = $arguments[0];
        $delimiter = $arguments[1];

        $args = 'A1, A2';
        $args .= (isset($arguments[2])) ? ", {$arguments[2]}" : ',';
        $args .= (isset($arguments[3])) ? ", {$arguments[3]}" : ',';
        $args .= (isset($arguments[4])) ? ", {$arguments[4]}" : ',';

        $worksheet = $this->getSheet();
        $worksheet->getCell('A1')->setValue($text);
        $worksheet->getCell('A2')->setValue($delimiter);
        $worksheet->getCell('B1')->setValue("=TEXTBEFORE({$args})");

        $result = $worksheet->getCell('B1')->getCalculatedValue();
        self::assertEquals($expectedResult, $result);
    }

    public function providerTEXTBEFORE(): array
    {
        return require 'tests/data/Calculation/TextData/TEXTBEFORE.php';
    }
}
