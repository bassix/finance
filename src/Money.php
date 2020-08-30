<?php
declare(strict_types=1);

namespace Bassix\Finance;

use Bassix\Finance\Exceptions\CurrencyMismatchException;
use Bassix\Finance\Helper\MathHelper;

class Money extends MathHelper
{
    protected string $amount = '0.0';

    protected ?Currency $currency = null;

    protected static ?Currency $currentCurrency = null;

    public function __construct($amount = '0.0', $currency = Currencies::NONE)
    {
        if ($amount instanceof self) {
            $amount = $amount->getAmount();

            if (null === $currency) {
                $currency = $amount->getCurrency();
            }
        }

        if (is_object($amount)) {
            throw new \InvalidArgumentException('The given amount to create money can\'t be a object!');
        }

        if (is_numeric($amount)) {
            $amount = (string)$amount;
        }

        if (null === $amount) {
            $amount = '0.0';
        }

        $this->amount = $amount;

        if ($currency instanceof Currency) {
            $this->currency = $currency;
        } else {
            $this->currency = self::handleCurrencyArgument($currency);
        }
    }

    /**
     * Returns a suitable string representation.
     *
     * @return string
     */
    public function __toString()
    {
        $decimalSeparator = '.';

        if (function_exists('trans')) {
            $decimalSeparator = trans('shop.decimal_separator');
        }

        $decimalDigits = $this->getCurrency()->getDecimalDigits();
        $amount = number_format(
            (float)MathHelper::bcRound($this->getAmount(), $decimalDigits),
            $decimalDigits,
            $decimalSeparator,
            ''
        );

        $symbol = $this->getCurrency()->getSymbol();

        if (null !== $symbol && !empty($symbol) && '?' !== $symbol) {
            return $amount . ' ' . $symbol;
        }

        return $amount . ' ' . $this->getCurrency()->getCode();
    }

    /**
     * Creates a new instance for the given amount and Currency.
     *
     * @param string   $amount   bcmath representation of the amount
     * @param Currency $currency based on ISO Code
     * @return Money
     */
    public static function valueOf($amount, $currency): Money
    {
        return new self($amount, $currency);
    }

    /**
     * Creates a new instance with zero amount and Currency None or optional.
     *
     * @param Currency $currency an optional currency to use
     * @return Money
     */
    public static function zero(Currency $currency = null): Money
    {
        if (null === $currency) {
            $currency = Currency::valueOf(Currencies::NONE);
        }

        return self::valueOf('0', $currency);
    }

    /**
     * Is the current amount zero?
     *
     * @return bool
     */
    public function isAmountZero(): bool
    {
        return 0 === bccomp('0', $this->amount, self::BCSCALE);
    }

    /**
     * Is the current currency 'NONE'?
     *
     * @return bool
     */
    public function isCurrencyNone(): bool
    {
        return Currencies::NONE === $this->currency->getCode();
    }

    /**
     * Creates a new instance with amount zero or optional and Currency None.
     *
     * @param string $amount an optional amount to use
     * @return Money
     */
    public static function noCurrency($amount = null): Money
    {
        if (null === $amount) {
            $amount = '0';
        }

        return self::valueOf((string)$amount, Currency::valueOf(Currencies::NONE));
    }

    /**
     * Gets the amount, bcmath representation of the amount.
     *
     * @param bool $rounded
     * @return Money|float|int|string
     */
    public function getAmount($rounded = false)
    {
        if (true === $rounded) {
            return self::bcRound($this->amount, $this->getCurrency()->getDecimalDigits());
        }

        return $this->amount;
    }

    public function format()
    {
        $floatAmount = (float)$this->getAmount(true);
        $currency = $this->getCurrency();
        $numberFormat = number_format($floatAmount, $currency->getDecimalDigits(), $currency->getDecimalSeparator(), $currency->getThousandsSeparator());
        $symbol = $currency->getSymbol();
        $format = $currency->getFormatTemplate();
        $vars = ['AMT' => $numberFormat, 'SYMBOL' => $symbol];

        foreach ($vars as $key => $value) {
            $format = str_replace('{' . $key . '}', $value, $format);
        }

        return $format;
    }

    /**
     * Gets the currency.
     *
     * @return Currency based on ISO Code
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Adds the given money to this one (immutable) and returns the result.
     *
     * @param Money $money the money to add
     * @return Money
     * @throws CurrencyMismatchException
     */
    public function add($money): Money
    {
        if (!$this->currency->equals($money->getCurrency())) {
            throw new CurrencyMismatchException($this . ' does not match ' . $money);
        }

        $amount = bcadd($this->amount, $money->getAmount(), self::getPrecisionInternal());

        return self::valueOf(MathHelper::bcRound($amount, self::BCSCALE), $this->currency);
    }

    /**
     * Subtract the given money from this one (immutable) and returns the result.
     *
     * @param Money $money the money to subtract
     * @return Money
     * @throws CurrencyMismatchException
     */
    public function sub($money): Money
    {
        if (!$this->currency->equals($money->getCurrency())) {
            throw new CurrencyMismatchException($this . ' does not match ' . $money);
        }

        $amount = bcsub($this->amount, $money->getAmount(), self::getPrecisionInternal());

        return self::valueOf(MathHelper::bcRound($amount, self::BCSCALE), $this->currency);
    }

    /**
     * Multiplies this money (immutable) with the given factor and returns the result.
     *
     * @param mixed $factor the factor to multiply with
     * @return Money
     * @throws \InvalidArgumentException if the $factor is not numeric
     */
    public function multiply($factor): Money
    {
        if (!is_numeric($factor)) {
            throw new \InvalidArgumentException('Factor must be numeric');
        }

        $amount = bcmul($this->amount, (string)$factor, self::BCSCALE);

        return self::valueOf($amount, $this->currency);
    }

    /**
     * Divides this money (immutable) by the given factor and returns the result.
     *
     * @param mixed $factor the factor to divide by
     * @return Money
     * @throws \InvalidArgumentException if the $factor is not numeric
     */
    public function divide($factor): Money
    {
        if (!is_numeric($factor)) {
            throw new \InvalidArgumentException('Factor must be numeric');
        }

        $amount = bcdiv($this->amount, (string)$factor, self::BCSCALE);

        return self::valueOf($amount, $this->currency);
    }

    /**
     * Method to get a currency object by currency string.
     *
     * @param Currency|string $currency
     * @return Currency
     * @throws \InvalidArgumentException
     */
    protected static function handleCurrencyArgument($currency = 'EUR'): Currency
    {
        if (null !== self::$currentCurrency) {
            return self::$currentCurrency;
        }

        if (!$currency instanceof Currency && !is_string($currency)) {
            //throw new InvalidArgumentException('$currency must be an object of type Currency or a string!');
            $currency = 'EUR';
        }

        return self::$currentCurrency = new Currency($currency);
    }
}
