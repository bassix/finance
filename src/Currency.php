<?php
declare(strict_types=1);

namespace Bassix\Finance;

use Bassix\Finance\Exceptions\FileNotFoundException;
use Bassix\Finance\Service\YamlService;

/**
 * Class Currency
 *
 * @package SUPR\FinanceBundle
 */
class Currency
{
    public const ISO_STATUS_ACTIVE = 'ISO_STATUS_ACTIVE';

    public const ISO_STATUS_WITHOUT_CURRENCY_CODE = 'ISO_STATUS_WITHOUT_CURRENCY_CODE';

    public const ISO_STATUS_UNOFFICIAL = 'ISO_STATUS_UNOFFICIAL';

    public const ISO_STATUS_HISTORICAL = 'ISO_STATUS_HISTORICAL';

    /**
     * The three-letter currency code
     *
     * @var string the three-letter currency code
     */
    private string $code;

    /**
     * One of 'ISO_STATUS_ACTIVE', 'ISO_STATUS_WITHOUT_CURRENCY_CODE', 'ISO_STATUS_UNOFFICIAL' or 'ISO_STATUS_HISTORICAL'
     *
     */
    private string $isoStatus;

    /**
     * The number of decimal places used for this currency
     *
     */
    private int $decimalDigits;

    /**
     * The name as specified in en.wikipedia.org
     *
     */
    private string $name;

    private string $decimalSeparator = '.';

    private string $thousandsSeparator = ',';

    private string $formatTemplate = '';

    private string $symbol = '';

    private static ?array $currencies = null;

    private static ?array $currenciesNoIsoCode = null;

    private static ?array $currenciesUnofficial = null;

    private static ?array $currenciesIncomplete = null;

    private static ?array $currenciesHistorical = null;

    /**
     * Currency constructor.
     *
     * @param string      $code          the three-letter currency code
     * @param string|null $isoStatus     one of 'ISO_STATUS_ACTIVE', 'ISO_STATUS_WITHOUT_CURRENCY_CODE', 'ISO_STATUS_UNOFFICIAL' or 'ISO_STATUS_HISTORICAL'
     * @param int|null    $decimalDigits the number of decimal places used for this currency
     * @param string|null $name          the name as specified in en.wikipedia.org
     * @param string|null $decimalSeparator
     * @param string|null $thousandsSeparator
     */
    public function __construct(
        $code = 'EUR',
        $isoStatus = null,
        $decimalDigits = null,
        $name = null,
        $decimalSeparator = null,
        $thousandsSeparator = null
    ) {
        if (null !== $isoStatus && null !== $decimalDigits && null !== $name) {
            $this->code = $code;
            $this->isoStatus = $isoStatus;
            $this->decimalDigits = $decimalDigits;
            $this->name = $name;
        } elseif (self::isValidCode($code)) {
            $details = self::getDetails($code);
            $this->code = $details['code'];
            $this->isoStatus = $details['isoStatus'];
            $this->decimalDigits = $details['decimalDigits'];
            $this->name = $details['name'];
            $this->decimalSeparator = $details['decimalSeparator'];
            $this->thousandsSeparator = $details['thousandsSeparator'];
            $this->formatTemplate = $details['formatTemplate'];
            $this->symbol = $details['symbol'];
        }

        // we need to stay down compatible...
        if (null !== $decimalSeparator && null !== $thousandsSeparator) {
            $this->decimalSeparator = $decimalSeparator;
            $this->thousandsSeparator = $thousandsSeparator;
        }
    }

    /**
     * Returns a suitable string representation of the currency.
     *
     * @return string the currency code
     * @see __toString()
     */
    public function __toString()
    {
        return (string)$this->code;
    }

    /**
     * @param string $code the three-letter currency code
     */
    public static function valueOf($code = Currencies::NONE): Currency
    {
        if (!self::isValidCode($code)) {
            throw new \InvalidArgumentException("Unknown currency code \"{$code}\"!");
        }

        $details = self::getDetails($code);
        $code = $details['code'];
        $isoStatus = $details['isoStatus'];
        $decimalDigits = $details['decimalDigits'];
        $name = $details['name'];

        return new Currency($code, $isoStatus, $decimalDigits, $name);
    }

    /**
     * Is the given code valid?
     *
     * @param string $code the three-letter currency code
     */
    public static function isValidCode($code): bool
    {
        if (array_key_exists($code, self::getInfoForCurrencies())) {
            return true;
        }

        if (array_key_exists($code, self::getInfoForCurrenciesWithoutCurrencyCode())) {
            return true;
        }

        if (array_key_exists($code, self::getInfoForCurrenciesWithUnofficialCode())) {
            return true;
        }

        if (array_key_exists($code, self::getInfoForCurrenciesWithHistoricalCode())) {
            return true;
        }

        if (array_key_exists($code, self::getInfoForCurrenciesIncomplete())) {
            return true;
        }

        return false;
    }

    /**
     * Get details about a given ISO currency code.
     *
     * @param string $code the three-letter currency code
     * @return array info about ISO currency
     */
    public static function getDetails($code): array
    {
        $infos = self::getInfoForCurrencies();

        if (array_key_exists($code, $infos)) {
            return $infos[$code];
        }

        $infos = self::getInfoForCurrenciesWithoutCurrencyCode();

        if (array_key_exists($code, $infos)) {
            return $infos[$code];
        }

        $infos = self::getInfoForCurrenciesWithUnofficialCode();

        if (array_key_exists($code, $infos)) {
            return $infos[$code];
        }

        $infos = self::getInfoForCurrenciesWithHistoricalCode();

        if (array_key_exists($code, $infos)) {
            return $infos[$code];
        }

        $infos = self::getInfoForCurrenciesIncomplete();

        if (array_key_exists($code, $infos)) {
            return $infos[$code];
        }

        throw new \InvalidArgumentException("Unknown currency code \"{$code}\"!");
    }

    public function setSymbol($symbol): void
    {
        $this->symbol = $symbol;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getFormatTemplate(): string
    {
        return $this->formatTemplate;
    }

    public function setFormatTemplate($formatTemplate): void
    {
        $this->formatTemplate = $formatTemplate;
    }

    public function getDecimalSeparator(): string
    {
        return $this->decimalSeparator;
    }

    public function setDecimalSeparator($decimalSeparator): void
    {
        $this->decimalSeparator = $decimalSeparator;
    }

    public function getThousandsSeparator(): string
    {
        return $this->thousandsSeparator;
    }

    public function setThousandsSeparator($thousandsSeparator): void
    {
        $this->thousandsSeparator = $thousandsSeparator;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Get the ISO Status one of 'ISO_STATUS_ACTIVE', 'ISO_STATUS_WITHOUT_CURRENCY_CODE', 'ISO_STATUS_UNOFFICIAL' or 'ISO_STATUS_HISTORICAL'.
     *
     */
    public function getIsoStatus(): string
    {
        return $this->isoStatus;
    }

    /**
     * Whether the ISO Status is 'ISO_STATUS_ACTIVE'.
     */
    public function isActive(): bool
    {
        return self::ISO_STATUS_ACTIVE === $this->isoStatus;
    }

    /**
     * Whether the ISO Status is 'ISO_STATUS_WITHOUT_CURRENCY_CODE'.
     *
     */
    public function isWithoutCurrencyCode(): bool
    {
        return self::ISO_STATUS_WITHOUT_CURRENCY_CODE === $this->isoStatus;
    }

    /**
     * Whether the ISO Status is 'ISO_STATUS_UNOFFICIAL'.
     *
     */
    public function isUnofficial(): bool
    {
        return self::ISO_STATUS_UNOFFICIAL === $this->isoStatus;
    }

    /**
     * Whether the ISO Status is 'ISO_STATUS_HISTORICAL'.
     *
     */
    public function isHistorical(): bool
    {
        return self::ISO_STATUS_HISTORICAL === $this->isoStatus;
    }

    /**
     * Set the number of decimal places used.
     *
     * @param int $decimalDigits
     */
    public function setDecimalDigits($decimalDigits): void
    {
        $this->decimalDigits = (int)$decimalDigits;
    }

    /**
     * Get the number of decimal places used.
     *
     */
    public function getDecimalDigits(): int
    {
        return $this->decimalDigits;
    }

    /**
     * Get the name as used on en.wikipedia.org
     *
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Whether this and another currency are the same. Uses only the code to determine identity.
     *
     * @param Currency $currency the currency to compare to
     */
    public function equals(Currency $currency): bool
    {
        return $currency->getCode() === $this->code;
    }

    /**
     * Get details about all active ISO Currencies.
     *
     * @return array info about active ISO currencies
     */
    public static function getInfoForCurrencies(): array
    {
        if (null !== self::$currencies) {
            self::$currencies;
        }

        try {
            $data = YamlService::getFromFile(__DIR__ . '/Resources/config/currencies.yml');
            // Select lang in config of currencies...
            $data['currencies'] = self::defineCurrencyLang($data['currencies']);
            self::$currencies = $data['currencies'];

            return self::$currencies;
        } catch (FileNotFoundException $exception) {
            // @todo we need some error handling but the application don't need to crash!
        }

        return [];
    }

    /**
     * Get the locale from the configuration.
     *
     */
    public static function getLocale(): string
    {
        $locale = locale_get_default();

        return strtolower(substr($locale, 0, 2));
    }

    /**
     * Adds options that depend on the language directly to the currency
     *
     * @param array $currencies
     */
    public static function defineCurrencyLang($currencies): array
    {
        $locale = self::getLocale();

        foreach ($currencies as $key => $currency) {
            if (isset($currency['lang'], $currency['lang'][$locale])) {
                $currencies[$key]['decimalSeparator'] = $currency['lang'][$locale]['decimalSeparator'];
                $currencies[$key]['thousandsSeparator'] = $currency['lang'][$locale]['thousandsSeparator'];
                $currencies[$key]['formatTemplate'] = $currency['lang'][$locale]['formatTemplate'];
            }
        }

        return $currencies;
    }

    /**
     * Get details about all Currencies without ISO Code.
     *
     * @return array info about Currencies without ISO Code
     */
    public static function getInfoForCurrenciesWithoutCurrencyCode(): array
    {
        if (null !== self::$currenciesNoIsoCode) {
            self::$currenciesNoIsoCode;
        }

        return self::$currenciesNoIsoCode = self::loadCurrenciesDefinition('noisocode');
    }

    /**
     * Get details about all unofficial Currencies.
     *
     * @return array info about unofficial Currencies
     */
    public static function getInfoForCurrenciesWithUnofficialCode(): array
    {
        if (null !== self::$currenciesUnofficial) {
            self::$currenciesUnofficial;
        }

        return self::$currenciesUnofficial = self::loadCurrenciesDefinition('unofficial');
    }

    /**
     * Get details about all incomplete Currencies.
     *
     * @return array info about incomplete Currencies
     */
    public static function getInfoForCurrenciesIncomplete(): array
    {
        if (null !== self::$currenciesIncomplete) {
            self::$currenciesIncomplete;
        }

        return self::$currenciesIncomplete = self::loadCurrenciesDefinition('incomplete');
    }

    /**
     * Get details about all historical ISO Currencies.
     *
     * @return array info about historical ISO Currencies
     */
    public static function getInfoForCurrenciesWithHistoricalCode(): array
    {
        if (null !== self::$currenciesHistorical) {
            self::$currenciesHistorical;
        }

        return self::$currenciesHistorical = self::loadCurrenciesDefinition('historical');
    }

    private static function loadCurrenciesDefinition(string $filename = null)
    {
        $configFile = __DIR__ . "/Resources/config/currencies_{$filename}.json";

        if (is_file($configFile)) {
            $data = file_get_contents($configFile);

            return json_decode($data, true);
        }

        return [];
    }
}
