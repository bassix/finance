<?php
declare(strict_types=1);

namespace Finance\Tests;

use Bassix\Finance\Price;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Bassix\Finance\Price
 */
class PriceTest extends TestCase
{
    public function testPriceNew(): void
    {
        $price = new Price(10000, 'EUR', 19.0);
        self::assertInstanceOf(Price::class, $price);
    }

    public function testTaxCalculationNineteen(): void
    {
        $price = new Price('100.00', 'EUR', 19.0);
        self::assertInstanceOf(Price::class, $price);

        self::assertEquals(0, bccomp('100.00', $price->getGross()->getAmount()));
        self::assertEquals(19.0, $price->getTaxRate());
        self::assertEquals(0, bccomp('84.0336', $price->getNet()->getAmount()));
        self::assertEquals(0, bccomp('15.9664', $price->getTax()->getAmount()));

        $price = new Price('119.00', 'EUR', 19.0);
        self::assertEquals(0, bccomp('119.00', $price->getGross()->getAmount()));
        self::assertEquals(19.0, $price->getTaxRate());
        self::assertEquals(0, bccomp('100.00', $price->getNet()->getAmount()));
        self::assertEquals(0, bccomp('19.00', $price->getTax()->getAmount()));

        $price = new Price('19.99', 'EUR', 19.0);
        self::assertEquals(0, bccomp('19.99', $price->getGross()->getAmount()));
        self::assertEquals(19.0, $price->getTaxRate());
        self::assertEquals(0, bccomp('16.7983', $price->getNet()->getAmount()));
        self::assertEquals(0, bccomp('3.1917', $price->getTax()->getAmount()));
    }

    public function testTaxCalculationSeven(): void
    {
        $price = new Price('26.58', 'EUR', 7.0);
        self::assertEquals(0, bccomp('26.58', $price->getAmount()));
        self::assertEquals(0, bccomp('26.58', $price->getGross()->getAmount()));
        self::assertEquals('7.0', $price->getTaxRate());
        self::assertEquals(0, bccomp('24.8411', $price->getNet()->getAmount()));
        self::assertEquals(0, bccomp('1.7389', $price->getTax()->getAmount()));

        $price = new Price('0.99', 'EUR', 7.0);
        self::assertEquals(0, bccomp('0.99', $price->getAmount()));
        self::assertEquals(0, bccomp('0.99', $price->getGross()->getAmount()));
        self::assertEquals(7.0, $price->getTaxRate());
        self::assertEquals(0, bccomp('0.9252', $price->getNet()->getAmount()));
        self::assertEquals(0, bccomp('0.0648', $price->getTax()->getAmount()));
    }

    public function testTaxCalculationRandom(): void
    {
        $price = new Price('1001.96', 'EUR', 16.9);
        self::assertEquals(0, bccomp('1001.96', $price->getAmount()));
        self::assertEquals(0, bccomp('1001.96', $price->getGross()->getAmount()));
        self::assertEquals('16.9', $price->getTaxRate());
        self::assertEquals(0, bccomp('857.1086', $price->getNet()->getAmount()));
        self::assertEquals(0, bccomp('144.8514', $price->getTax()->getAmount()));
    }

    public function testPriceAddPrice(): void
    {
        $price1 = new Price('6.59', 'EUR', 19.0);
        $price2 = new Price('19.99', 'EUR', 19.0);
        $price3 = $price1->add($price2);
        self::assertEquals(0, bccomp('26.58', $price3->getAmount()));
        self::assertEquals(0, bccomp('26.58', $price3->getGross()->getAmount()));
        self::assertEquals(19.0, $price3->getTaxRate());
        self::assertEquals(0, bccomp('22.3361', $price3->getNet()->getAmount()));
        self::assertEquals(0, bccomp('4.2439', $price3->getTax()->getAmount()));

        $price4 = new Price('5.99', 'EUR', 7.0);
        $price5 = new Price('24.9', 'EUR', 7.0);
        $price6 = $price4->add($price5);
        self::assertEquals(0, bccomp('30.89', $price6->getAmount()));
        self::assertEquals(0, bccomp('30.89', $price6->getGross()->getAmount()));
        self::assertEquals('7.0', $price6->getTaxRate());
        self::assertEquals(0, bccomp('28.8692', $price6->getNet()->getAmount()));
        self::assertEquals(0, bccomp('2.0208', $price6->getTax()->getAmount()));
    }

    public function testPriceUpdate(): void
    {
        foreach ($this->getPriceUpdateTestCases() as $index => $testCase) {
            $actual = $testCase['actual'];
            $price = new Price($actual['amount'], $actual['currency'], $actual['taxRate'], $actual['hasTax']);
            $expected = $testCase['expected'];
            self::assertEquals(0, bccomp($expected['amount'], $price->getAmount()), sprintf('Get Amount at test case "%s" failed!', $index));
            self::assertEquals(0, bccomp($expected['grossAmount'], $price->getGross()->getAmount()), sprintf('Get gross amount at test case "%s" failed!', $index));
            self::assertEquals($expected['taxRate'], $price->getTaxRate(), sprintf('Get tax rate at test case "%s" failed!', $index));
            self::assertEquals($expected['hasTax'], $price->getHasTax(), sprintf('Get has tax at test case "%s" failed!', $index));
            self::assertEquals($expected['hasTax'], $price->hasTax(), sprintf('Has tax at test case "%s" failed!', $index));
            self::assertEquals(0, bccomp($expected['netAmount'], $price->getNet()->getAmount()), sprintf('Get net amount at test case "%s" failed!', $index));
            self::assertEquals(0, bccomp($expected['taxAmount'], $price->getTax()->getAmount()), sprintf('Get tax amount at test case "%s" failed!', $index));
        }
    }

    private function getPriceUpdateTestCases(): array
    {
        $cases[0] = [
            'actual' => [
                'amount' => '26.58',
                'currency' => 'EUR',
                'taxRate' => 7.0,
                'hasTax' => true,
            ],
            'expected' => [
                'amount' => '26.58',
                'grossAmount' => '26.58',
                'taxRate' => 7.0,
                'hasTax' => true,
                'netAmount' => '24.8411',
                'taxAmount' => '1.7389',
            ],
        ];
        $cases[1] = [
            'actual' => [
                'amount' => '0.99',
                'currency' => 'EUR',
                'taxRate' => 7.0,
                'hasTax' => true,
            ],
            'expected' => [
                'amount' => '0.99',
                'grossAmount' => '0.99',
                'taxRate' => 7.0,
                'hasTax' => true,
                'netAmount' => '0.9252',
                'taxAmount' => '0.0648',
            ],
        ];
        $cases[2] = [
            'actual' => [
                'amount' => '1.49',
                'currency' => 'EUR',
                'taxRate' => 0.0,
                'hasTax' => true,
            ],
            'expected' => [
                'amount' => '1.49',
                'grossAmount' => '1.49',
                'taxRate' => 0.0,
                'hasTax' => true,
                'netAmount' => '1.49',
                'taxAmount' => '0.0',
            ],
        ];
        $cases[3] = [
            'actual' => [
                'amount' => '421.9847',
                'currency' => 'EUR',
                'taxRate' => 26.58,
                'hasTax' => false,
            ],
            'expected' => [
                'amount' => '333.3739',
                'grossAmount' => '421.9847',
                'taxRate' => 26.58,
                'hasTax' => false,
                'netAmount' => '333.3739',
                'taxAmount' => '88.6108',
            ],
        ];
        $cases[4] = [
            'actual' => [
                'amount' => '2147483647.4294967295',
                'currency' => 'EUR',
                'taxRate' => 99.9999,
                'hasTax' => true,
            ],
            'expected' => [
                'amount' => '2147483647.4294967295',
                'grossAmount' => '2147483647.4294967295',
                'taxRate' => 99.9999,
                'hasTax' => true,
                'netAmount' => '1073742360.5859',
                'taxAmount' => '1073741286.8436',
            ],
        ];

        return $cases;
    }
}
