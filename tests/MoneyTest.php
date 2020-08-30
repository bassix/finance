<?php
declare(strict_types=1);

namespace Finance\Tests;

use Bassix\Finance\Currencies;
use Bassix\Finance\Currency;
use Bassix\Finance\Money;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Bassix\Finance\Money
 */
class MoneyTest extends TestCase
{
    /**
     * Shortcut for zero amount Money.
     */
    public function testZeroWithCurrency(): void
    {
        $currency = Currency::valueOf(Currencies::TEST);
        $money = Money::zero($currency);

        // 0 decimalDigits
        self::assertEquals('0', $money->getAmount());
        self::assertEquals($currency, $money->getCurrency());
        self::assertEquals('0 ' . $currency, $money->__toString());
    }

    /**
     * Shortcut for zero amount MoneyComplexs without even a Currency.
     */
    public function testZeroWithoutCurrency(): void
    {
        $money = Money::zero();

        self::assertEquals('0', $money->getAmount());
        self::assertEquals(Currency::valueOf(Currencies::NONE), $money->getCurrency());
        self::assertEquals('0 ' . Currencies::NONE, $money->__toString());
    }

    /**
     * Is zero amount detected?
     */
    public function testIsAmountZero(): void
    {
        $amount = '0';
        $currency = Currency::valueOf(Currencies::TEST);
        $money = Money::valueOf($amount, $currency);
        self::assertTrue($money->isAmountZero());
    }

    /**
     * Is non-zero amount detected?
     */
    public function testIsAmountNotZero(): void
    {
        $amount = '23';
        $currency = Currency::valueOf(Currencies::TEST);
        $money = Money::valueOf($amount, $currency);
        self::assertFalse($money->isAmountZero());
    }

    /**
     * Shortcut for currency-less Money.
     */
    public function testNoCurrencyWithAmount(): void
    {
        $amount = '23';
        $money = Money::noCurrency($amount);

        self::assertEquals($amount, $money->getAmount());
        self::assertEquals(Currencies::NONE, $money->getCurrency()->getCode());
        self::assertEquals($amount . ' ' . Currencies::NONE, $money->__toString());
    }

    /**
     * Shortcut for currency-less Money without even an amount.
     */
    public function testNoCurrencyWithoutAmount(): void
    {
        $money = Money::noCurrency();

        self::assertEquals('0', $money->getAmount());
        self::assertEquals(Currencies::NONE, $money->getCurrency()->getCode());
        self::assertEquals('0 ' . Currencies::NONE, $money->__toString());
    }

    /**
     * Is no currency detected?
     */
    public function testIsCurrencyNone(): void
    {
        $amount = '23';
        $currency = Currency::valueOf(Currencies::NONE);
        $money = Money::valueOf($amount, $currency);
        self::assertTrue($money->isCurrencyNone());
    }

    /**
     * Is currency detected?
     */
    public function testIsCurrencyNotNone(): void
    {
        $amount = '23';
        $currency = Currency::valueOf(Currencies::TEST);
        $money = Money::valueOf($amount, $currency);
        self::assertFalse($money->isCurrencyNone());
    }

    /**
     * Adding with matching Currencies.
     */
    public function testAddingSucceeds(): void
    {
        $amountOne = '23';
        $currencyOne = Currency::valueOf(Currencies::TEST);
        $moneyOne = Money::valueOf($amountOne, $currencyOne);

        $amountTwo = '42';
        $currencyTwo = $currencyOne;
        $moneyTwo = Money::valueOf($amountTwo, $currencyTwo);

        $expected = bcadd($amountOne, $amountTwo);
        $actual = $moneyOne->add($moneyTwo);

        self::assertEquals(0, bccomp($expected, $actual->getAmount()));
        self::assertEquals($currencyOne, $actual->getCurrency());
    }

    public function testCurrencyFormattingUSD(): void
    {
        setlocale(LC_ALL, 'en_US.UTF-8');

        $moneyDollar = new Money(10.5587, new Currency(Currencies::CODE_USD));

        self::assertEquals('$10.56', $moneyDollar->format());
    }

    /**
     * @i
     */
    public function testCurrencyFormattingEUR(): void
    {
        self::markTestSkipped('We skip this method because of: "The given string or number "xx,xxxx" is not a valid working boolean value!"');

        /**
         * @todo We have a problem! In DE is decimal separator "," but our finance works with "." :/
         *
         * To checken:
         * setlocale(LC_ALL, "de_DE.UTF-8");
         * $float = 10.5555;
         * var_dump($float);
         *
         * $string = (string)$float;
         * var_dump($string);
         *
         * $float = (float)$string;
         * var_dump($float);
         */
        /*
        setlocale(LC_ALL, 'de_DE.UTF-8');
        $moneyEuro = new Money(10.5589, new Currency(Currencies::CODE_EUR));
        self::assertEquals('10,56 €', $moneyEuro->format());
        */
    }
}
