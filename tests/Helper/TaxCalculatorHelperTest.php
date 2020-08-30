<?php
declare(strict_types=1);

namespace SUPR\BaseBundle\Tests\Helper;

use Bassix\Finance\Helper\TaxCalculatorHelper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Bassix\Finance\Helper\TaxCalculatorHelper
 */
class TaxCalculatorHelperTest extends TestCase
{
    public function testTaxCalculatorHelper(): void
    {
        foreach ($this->getTestCases() as $index => $testCase) {
            self::assertEquals(
                bccomp(
                    $testCase['expected']['net'],
                    TaxCalculatorHelper::getNetPriceFromGross($testCase['actual']['gross'], $testCase['actual']['taxRate'], $testCase['actual']['precision'])
                ),
                0,
                sprintf('The test case at row "%s" is to get net from gross!', $index)
            );
            self::assertEquals(
                bccomp(
                    $testCase['expected']['tax'],
                    TaxCalculatorHelper::getTaxCostFromGross($testCase['actual']['gross'], $testCase['actual']['taxRate'], $testCase['actual']['precision'])
                ),
                0,
                sprintf('The test case at row "%s" is to get tax from gross!', $index)
            );
        }
    }

    public function testTaxCalculatorHelperSpecialCases(): void
    {
        self::assertEquals('15.1261', TaxCalculatorHelper::getNetPriceFromGross('18.0', 19, 4));
        self::assertEquals('15.4206', TaxCalculatorHelper::getNetPriceFromGross('16.5', 7, 4));
    }

    // -- PRIVATE ------------------------------------------------------------------------------------------------------

    private function getTestCases(): array
    {
        return [
            0 => [
                'expected' => ['net' => '100.0000', 'tax' => '7.0000'],
                'actual' => ['gross' => '107.00', 'taxRate' => 7, 'precision' => 4],
            ],
            1 => [
                'expected' => ['net' => '100.0000', 'tax' => '19.0000'],
                'actual' => ['gross' => '119.00', 'taxRate' => 19, 'precision' => 4],
            ],
            2 => [
                'expected' => ['net' => '84.0336', 'tax' => '15.9664'],
                'actual' => ['gross' => '100.00', 'taxRate' => 19, 'precision' => 4],
            ],
            3 => [
                'expected' => ['net' => '857.1086', 'tax' => '144.8514'],
                'actual' => ['gross' => '1001.96', 'taxRate' => 16.9, 'precision' => 4],
            ],
            4 => [
                'expected' => ['net' => '29.87', 'tax' => '0.0'],
                'actual' => ['gross' => '29.87', 'taxRate' => 0, 'precision' => 4],
            ],
            5 => [
                'expected' => ['net' => '263.7698', 'tax' => '257.6767'],
                'actual' => ['gross' => '521.4465', 'taxRate' => '97.69', 'precision' => 4],
            ],
            6 => [
                'expected' => ['net' => '63.0252', 'tax' => '11.9748'],
                'actual' => ['gross' => '75', 'taxRate' => '19', 'precision' => 4],
            ],
        ];
    }
}
