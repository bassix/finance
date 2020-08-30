<?php
declare(strict_types=1);

namespace Finance\Tests\Helper;

use Bassix\Finance\Helper\TaxHelper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Bassix\Finance\Helper\TaxHelper
 */
class TaxHelperTest extends TestCase
{
    public function testGetNetAmount(): void
    {
        foreach ($this->getAmountCases() as $row => $case) {
            $amount = TaxHelper::getNetMoney($case['unitAmount'], $case['taxRate'], $case['currency'], $case['quantity'], $case['hasTax']);
            self::assertEquals($amount->getCurrency()->getCode(), $case['currency'], sprintf('The test at row "%s" expects currency "%s" if currency "%s" is given!', $row, $case['currency'], $case['currency']));
            self::assertEquals($amount->getAmount(), $case['netAmount'], sprintf('The test at row "%s" expects net amount "%s" if amount "%s" with tax rate "%s" is given!', $row, $case['netAmount'], $case['unitAmount'], $case['taxRate']));
        }
    }

    public function testGetGrossAmount(): void
    {
        foreach ($this->getAmountCases() as $row => $case) {
            $amount = TaxHelper::getGrossMoney($case['unitAmount'], $case['taxRate'], $case['currency'], $case['quantity'], $case['hasTax']);
            self::assertEquals($amount->getCurrency()->getCode(), $case['currency'], sprintf('The test at row "%s" expects currency "%s" if currency "%s" is given!', $row, $case['currency'], $case['currency']));
            self::assertEquals($amount->getAmount(), $case['grossAmount'], sprintf('The test at row "%s" expects gross amount "%s" if amount "%s" with tax rate "%s" is given!', $row, $case['netAmount'], $case['unitAmount'], $case['taxRate']));
        }
    }

    public function testGetTaxAmount(): void
    {
        foreach ($this->getAmountCases() as $row => $case) {
            $amount = TaxHelper::getTaxMoney($case['unitAmount'], $case['taxRate'], $case['currency'], $case['quantity'], $case['hasTax']);
            self::assertEquals($amount->getCurrency()->getCode(), $case['currency'], sprintf('The test at row "%s" expects currency "%s" if currency "%s" is given!', $row, $case['currency'], $case['currency']));
            self::assertEquals($amount->getAmount(), $case['taxAmount'], sprintf('The test at row "%s" expects tax amount "%s" if amount "%s" with tax rate "%s" is given!', $row, $case['taxAmount'], $case['unitAmount'], $case['taxRate']));
        }
    }

    private function getAmountCases(): array
    {
        return [
            0 => ['unitAmount' => 0, 'taxRate' => 0, 'currency' => 'EUR', 'quantity' => 0, 'hasTax' => false, 'netAmount' => 0, 'grossAmount' => 0, 'taxAmount' => 0],
            1 => ['unitAmount' => 0, 'taxRate' => 0, 'currency' => 'EUR', 'quantity' => 0, 'hasTax' => true, 'netAmount' => 0, 'grossAmount' => 0, 'taxAmount' => 0],
            2 => ['unitAmount' => 100, 'taxRate' => 0, 'currency' => 'EUR', 'quantity' => 1, 'hasTax' => false, 'netAmount' => 100, 'grossAmount' => 100, 'taxAmount' => 0],
            3 => ['unitAmount' => 100, 'taxRate' => 19, 'currency' => 'EUR', 'quantity' => 2, 'hasTax' => true, 'netAmount' => 168.0672, 'grossAmount' => 200, 'taxAmount' => 31.9327],
            4 => ['unitAmount' => 99.9999, 'taxRate' => 19, 'currency' => 'EUR', 'quantity' => 1, 'hasTax' => true, 'netAmount' => 84.0335, 'grossAmount' => 99.9999, 'taxAmount' => 15.9663],
            5 => ['unitAmount' => 99.9999, 'taxRate' => 19.5, 'currency' => 'GBP', 'quantity' => 1, 'hasTax' => true, 'netAmount' => 83.6819, 'grossAmount' => 99.9999, 'taxAmount' => 16.3179],
            6 => ['unitAmount' => 83.6819, 'taxRate' => 19.5, 'currency' => 'GBP', 'quantity' => 1, 'hasTax' => false, 'netAmount' => 83.6819, 'grossAmount' => 99.9998, 'taxAmount' => 16.3179],
            7 => ['unitAmount' => 0.99, 'taxRate' => 16, 'currency' => 'GBP', 'quantity' => 1, 'hasTax' => true, 'netAmount' => 0.8534, 'grossAmount' => 0.99, 'taxAmount' => 0.1365],
            8 => ['unitAmount' => 0.99, 'taxRate' => 16, 'currency' => 'USD', 'quantity' => 15, 'hasTax' => false, 'netAmount' => 14.85, 'grossAmount' => 17.226, 'taxAmount' => 2.376],
        ];
    }
}
