<?php
declare(strict_types=1);

namespace Bassix\Finance;

use Bassix\Finance\Exceptions\CurrencyMismatchException;
use Bassix\Finance\Helper\MathHelper;
use Bassix\Finance\Helper\TaxCalculatorHelper;

class Price extends Money
{
    private bool $hasTax;

    private float $taxRate;

    private Money $tax;

    private Money $gross;

    private Money $net;

    /**
     * Construct a price...
     *
     * @param string|int|float $amount   bcmath representation of the amount
     * @param Currency|string  $currency based on ISO Code
     * @param string|float     $taxRate  The tax rate in percent
     * @param bool             $hasTax   Should a tax be computed?
     */
    public function __construct($amount = '0.0', $currency = 'EUR', $taxRate = '0.0', $hasTax = true)
    {
        parent::__construct($amount, $currency);
        $this->taxRate = $taxRate;
        $this->hasTax = $hasTax;
        $this->takeTaxFromMoney();
    }

    /**
     * Creates a new instance for the given amount and Currency.
     *
     * @param string|int|float $amount   bcmath representation of the amount
     * @param Currency|string  $currency based on ISO Code
     * @param string|float     $taxrate  Der Steuersatz in Prozent
     * @param bool             $hasTax   Soll eine Steuer berechnet werden?
     * @return Price
     */
    public static function valueOf($amount, $currency, $taxrate = 0.0, $hasTax = true): Price
    {
        return new self($amount, $currency, $taxrate, $hasTax);
    }

    /**
     * Adds the given price to this one (immutable) and returns the result.
     *
     * @param Price|Money $price the money to add
     * @return Price
     * @throws CurrencyMismatchException if the Currencies do not match
     */
    public function add($price): Price
    {
        if (!$this->currency->equals($price->getCurrency())) {
            throw new CurrencyMismatchException($this . ' does not match ' . $price);
        }

        // Attention! Internally we always calculate in gross!!!
        //$amount = bcadd($this->amount, $price->getAmount(), parent::getPrecisionInternal());
        $amount = bcadd($this->amount, $price->getGross()->getAmount(), self::getPrecisionInternal());

        return new Price(MathHelper::bcRound($amount, self::BCSCALE), $this->currency, $this->taxRate, $this->hasTax);
    }

    /**
     * Subtract the given price from this one (immutable) and returns the result.
     *
     * @param Price|Money $price the money to subtract
     * @return Price
     * @throws CurrencyMismatchException if the Currencies do not match
     */
    public function sub($price): Price
    {
        if (!$this->currency->equals($price->getCurrency())) {
            throw new CurrencyMismatchException($this . ' does not match ' . $price);
        }

        // Attention! Internally we always calculate in gross!!!
        //$amount = bcsub($this->amount, $price->getAmount(), parent::getPrecisionInternal());
        $amount = bcsub($this->amount, $price->getGross()->getAmount(), parent::getPrecisionInternal());

        return new Price(MathHelper::bcRound($amount, self::BCSCALE), $this->currency, $this->taxRate, $this->hasTax);
    }

    /**
     * Multiplies this money (immutable) with the given factor and returns the result.
     *
     * @param mixed $factor the factor to multiply with
     * @return Price
     * @throws \InvalidArgumentException if the $factor is not numeric
     */
    public function multiply($factor): Price
    {
        if (!is_numeric($factor)) {
            throw new \InvalidArgumentException('Factor must be numeric');
        }

        $amount = bcmul($this->amount, (string)$factor, self::getPrecisionInternal());

        return static::valueOf(
            MathHelper::bcRound($amount, self::BCSCALE),
            $this->currency,
            $this->taxRate,
            $this->hasTax
        );
    }

    // -- AMOUNT -------------------------------------------------------------------------------------------------------

    /**
     * Method for reading the amount that is actually to be calculated.
     *
     * @return Money
     */
    public function getMoney(): Money
    {
        if (false === $this->hasTax) {
            return $this->getNet();
        }

        return $this->getGross();
    }

    /**
     * Method for reading the amount that should really be calculated.
     *
     * @param bool $rounded
     * @return string
     */
    public function getAmount($rounded = false): string
    {
        if (false === $this->hasTax) {
            return $this->getNet()->getAmount($rounded);
        }

        return $this->getGross()->getAmount($rounded);
    }

    public function setHasTax($hasTax = null): self
    {
        if (null !== $hasTax) {
            $this->hasTax = filter_var($hasTax, FILTER_VALIDATE_BOOLEAN);
        }

        return $this;
    }

    public function getHasTax(): bool
    {
        return $this->hasTax;
    }

    public function hasTax($hasTax = null): bool
    {
        if (null !== $hasTax) {
            $this->setHasTax($hasTax);
        }

        return $this->hasTax;
    }

    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    public function getTax(): Money
    {
        return $this->tax;
    }

    /**
     * @return Money
     */
    public function getGross(): Money
    {
        return $this->gross;
    }

    public function getNet(): Money
    {
        return $this->net;
    }

    /**
     * Method that calculates the net price, gross price and taxes from the specified price.
     */
    private function takeTaxFromMoney(): void
    {
        // Gross price = net price + taxes
        $this->gross = new Money($this->amount, $this->getCurrency());

        // Net price = gross price - taxes
        $this->net = new Money(
            TaxCalculatorHelper::getNetPriceFromGross($this->amount, $this->getTaxRate()),
            $this->getCurrency()
        );

        // taxes = gross price - net price
        $this->tax = new Money(
            TaxCalculatorHelper::getTaxCostFromGross($this->amount, $this->getTaxRate()),
            $this->getCurrency()
        );
    }
}
