<?php
declare(strict_types=1);

namespace SUPR\BaseBundle\Tests;

use Bassix\Finance\Currencies;
use Bassix\Finance\Currency;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Bassix\Finance\Currency
 */
class CurrencyTest extends TestCase
{
    /**
     * Active codes must be instantiable.
     */
    public function testActiveCodeIsInstantiable(): void
    {
        $currency = Currency::valueOf(Currencies::CODE_AED);
        self::assertNotNull($currency);
    }

    /**
     * Without currency codes must be instantiable.
     */
    public function testWithoutCurrencyCodeIsInstantiable(): void
    {
        $currency = Currency::valueOf(Currencies::WITHOUT_CURRENCY_CODE_GGP);
        self::assertNotNull($currency);
    }

    /**
     * Unofficial codes must be instantiable.
     */
    public function testUnofficialCodeIsInstantiable(): void
    {
        $currency = Currency::valueOf(Currencies::UNOFFICIAL_BTC);
        self::assertNotNull($currency);
    }

    /**
     * Historical codes must be instantiable.
     */
    public function testHistoricalCodeIsInstantiable(): void
    {
        $currency = Currency::valueOf(Currencies::HISTORICAL_ADF);
        self::assertNotNull($currency);
    }

    /**
     * Invalid codes must not be instantiable.
     */
    public function testInvalidCodeIsNotInstantiable(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Currency::valueOf('Most certainly not a valid code');
    }

    /**
     * Active codes must be validated.
     */
    public function testActiveCodeIsValid(): void
    {
        self::assertTrue(Currency::isValidCode(Currencies::CODE_AED));
    }

    /**
     * Without currency codes must be validated.
     */
    public function testWithoutCurrencyCodeIsValid(): void
    {
        self::assertTrue(Currency::isValidCode(Currencies::WITHOUT_CURRENCY_CODE_GGP));
    }

    /**
     * Unofficial codes must be validated.
     */
    public function testUnofficialCodeIsValid(): void
    {
        self::assertTrue(Currency::isValidCode(Currencies::UNOFFICIAL_BTC));
    }

    /**
     * Historical codes must be validated.
     */
    public function testHistoricalCodeIsValid(): void
    {
        self::assertTrue(Currency::isValidCode(Currencies::HISTORICAL_ADF));
    }

    /**
     * Invalid codes must be rejected.
     */
    public function testInvalidCodeIsNotValid(): void
    {
        self::assertFalse(Currency::isValidCode('Most certainly not a valid code'));
    }

    /**
     * A known code should provide $code, $isoStatus, $decimalDigits and $name.
     */
    public function testGettingDetailsForKnownCodeSucceeds(): void
    {
        $expected = [
            'code' => Currencies::CODE_XTS,
            'isoStatus' => Currency::ISO_STATUS_ACTIVE,
            'decimalDigits' => 0,
            'name' => 'Code reserved for testing purposes',
            'decimalSeparator' => '.',
            'thousandsSeparator' => ',',
            'formatTemplate' => '{AMT} {SYMBOL}',
            'symbol' => '?',
        ];

        $actual = Currency::getDetails(Currencies::TEST);
        self::assertEquals($expected, $actual);
    }

    /**
     * An unknown Code cannot provide details.
     */
    public function testGettingDetailsForUnknownCodeFails(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Currency::getDetails('Most certainly not a valid code');
    }

    /**
     * Test Currency has a string representation of 'XTS'.
     */
    public function testToStringReturnsCode(): void
    {
        $currency = Currency::valueOf(Currencies::TEST);

        self::assertEquals(Currencies::TEST, $currency->__toString());
    }

    /**
     * Test Currency has an ISO Code of 'XTS'.
     */
    public function testCodeIsReturned(): void
    {
        $currency = Currency::valueOf(Currencies::TEST);

        self::assertEquals('XTS', $currency->getCode());
    }

    /**
     * Test Currency is an active ISO Code.
     */
    public function testIsoStatusIsReturned(): void
    {
        $currency = Currency::valueOf(Currencies::TEST);

        self::assertEquals(Currency::ISO_STATUS_ACTIVE, $currency->getIsoStatus());
    }

    /**
     * Active codes must be identifiable.
     */
    public function testActiveCodeIsIdentified(): void
    {
        $currency = Currency::valueOf(Currencies::CODE_AED);

        self::assertTrue($currency->isActive());
        self::assertFalse($currency->isWithoutCurrencyCode());
        self::assertFalse($currency->isUnofficial());
        self::assertFalse($currency->isHistorical());
    }

    /**
     * Without currency codes must be identifiable.
     */
    public function testWithoutCurrencyCodeIsIdentified(): void
    {
        $currency = Currency::valueOf(Currencies::WITHOUT_CURRENCY_CODE_GGP);

        self::assertFalse($currency->isActive());
        self::assertTrue($currency->isWithoutCurrencyCode());
        self::assertFalse($currency->isUnofficial());
        self::assertFalse($currency->isHistorical());
    }

    /**
     * Unofficial codes must be identifiable.
     */
    public function testUnofficialCodeIsIdentified(): void
    {
        $currency = Currency::valueOf(Currencies::UNOFFICIAL_BTC);

        self::assertFalse($currency->isActive());
        self::assertFalse($currency->isWithoutCurrencyCode());
        self::assertTrue($currency->isUnofficial());
        self::assertFalse($currency->isHistorical());
    }

    /**
     * Historical codes must be identifiable.
     */
    public function testHistoricalCodeIsIdentified(): void
    {
        $currency = Currency::valueOf(Currencies::HISTORICAL_ADF);

        self::assertFalse($currency->isActive());
        self::assertFalse($currency->isWithoutCurrencyCode());
        self::assertFalse($currency->isUnofficial());
        self::assertTrue($currency->isHistorical());
    }

    /**
     * Test Currency has 0 decimal digits.
     */
    public function testNumberOfDecimalDigitsIsReturned(): void
    {
        $currency = Currency::valueOf(Currencies::TEST);

        self::assertEquals(0, $currency->getDecimalDigits());
    }

    /**
     * Test Currency has a name of 'Code reserved for testing purposes'.
     */
    public function testNameIsReturned(): void
    {
        $currency = Currency::valueOf(Currencies::TEST);

        self::assertEquals('Code reserved for testing purposes', $currency->getName());
    }

    /**
     * Currencies with the same Code are equal.
     */
    public function testCurrenciesAreEqual(): void
    {
        $currencyOne = Currency::valueOf(Currencies::TEST);
        $currencyTwo = Currency::valueOf(Currencies::TEST);

        self::assertTrue($currencyOne->equals($currencyTwo));
    }

    /**
     * Currencies with the same Code are equal.
     */
    public function testCurrenciesAreNotEqual(): void
    {
        $currencyOne = Currency::valueOf(Currencies::TEST);
        $currencyTwo = Currency::valueOf(Currencies::CODE_XAU);

        self::assertFalse($currencyOne->equals($currencyTwo));
    }

    /**
     * Check active codes.
     */
    public function testInfoForActiveCodes(): void
    {
        foreach (Currency::getInfoForCurrencies() as $info) {
            self::assertArrayHasKey('code', $info);
            self::assertArrayHasKey('isoStatus', $info);
            self::assertEquals(Currency::ISO_STATUS_ACTIVE, $info['isoStatus']);
            self::assertArrayHasKey('decimalDigits', $info);
            self::assertGreaterThanOrEqual(0, $info['decimalDigits']);
            self::assertArrayHasKey('name', $info);
        }
    }

    /**
     * Check currencies without codes.
     */
    public function testInfoForCurrenciesWithoutCodes(): void
    {
        foreach (Currency::getInfoForCurrenciesWithoutCurrencyCode() as $info) {
            self::assertArrayHasKey('code', $info);
            self::assertArrayHasKey('isoStatus', $info);
            self::assertEquals(Currency::ISO_STATUS_WITHOUT_CURRENCY_CODE, $info['isoStatus']);
            self::assertArrayHasKey('decimalDigits', $info);
            self::assertGreaterThanOrEqual(0, $info['decimalDigits']);
            self::assertArrayHasKey('name', $info);
        }
    }

    /**
     * Check unofficial codes.
     */
    public function testInfoForUnofficialCodes(): void
    {
        foreach (Currency::getInfoForCurrenciesWithUnofficialCode() as $info) {
            self::assertArrayHasKey('code', $info);
            self::assertArrayHasKey('isoStatus', $info);
            self::assertEquals(Currency::ISO_STATUS_UNOFFICIAL, $info['isoStatus']);
            self::assertArrayHasKey('decimalDigits', $info);
            self::assertGreaterThanOrEqual(0, $info['decimalDigits']);
            self::assertArrayHasKey('name', $info);
        }
    }

    /**
     * Check historical codes.
     */
    public function testInfoForHistoricalCodes(): void
    {
        foreach (Currency::getInfoForCurrenciesWithHistoricalCode() as $info) {
            self::assertArrayHasKey('code', $info);
            self::assertArrayHasKey('isoStatus', $info);
            self::assertEquals(Currency::ISO_STATUS_HISTORICAL, $info['isoStatus']);
            self::assertArrayHasKey('decimalDigits', $info);
            self::assertGreaterThanOrEqual(0, $info['decimalDigits']);
            self::assertArrayHasKey('name', $info);
        }
    }
}
