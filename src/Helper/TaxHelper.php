<?php
declare(strict_types=1);

namespace Bassix\Finance\Helper;

use Bassix\Finance\Currency;
use Bassix\Finance\Money;

class TaxHelper
{
    /**
     * Calculate NetAmount
     *
     * @param Money|float|string $unitAmount
     * @param int|string         $taxRate
     * @param Currency|string    $currency
     * @param int                $quantity
     * @param bool               $hasTax
     */
    public static function getNetMoney($unitAmount, $taxRate, $currency, $quantity = 1, $hasTax = false): Money
    {
        if (!($currency instanceof Currency)) {
            $currency = new Currency($currency);
        }

        if (!($unitAmount instanceof Money)) {
            $unitAmount = new Money($unitAmount, $currency);
        }

        if ($hasTax) {
            $unitAmount = $unitAmount->multiply(1 / (1 + $taxRate / 100) * $quantity);
        } else {
            $unitAmount = $unitAmount->multiply($quantity);
        }

        return $unitAmount;
    }

    /**
     * Calculate GrossAmount
     *
     * @param Money|float|string $unitAmount
     * @param int|string         $taxRate
     * @param Currency|string    $currency
     * @param int                $quantity
     * @param bool               $hasTax
     */
    public static function getGrossMoney($unitAmount, $taxRate, $currency, $quantity = 1, $hasTax = false): Money
    {
        if (!($currency instanceof Currency)) {
            $currency = new Currency($currency);
        }

        if (!($unitAmount instanceof Money)) {
            $unitAmount = new Money($unitAmount, $currency);
        }

        if ($hasTax) {
            return $unitAmount->multiply($quantity);
        }

        return $unitAmount->multiply((1 + $taxRate / 100) * $quantity);
    }

    /**
     * Calculate TaxAmount
     *
     * @param Money|float|string $unitAmount
     * @param int|string         $taxRate
     * @param Currency|string    $currency
     * @param int                $quantity
     * @param bool               $hasTax
     */
    public static function getTaxMoney($unitAmount, $taxRate, $currency, $quantity = 1, $hasTax = false): Money
    {
        if (!($currency instanceof Currency)) {
            $currency = new Currency($currency);
        }

        if (!($unitAmount instanceof Money)) {
            $unitAmount = new Money($unitAmount, $currency);
        }

        if ($hasTax) {
            $taxAmount = $unitAmount->multiply(1 / (100 + $taxRate) * $taxRate * $quantity);
        } else {
            $taxAmount = $unitAmount->multiply($taxRate / 100 * $quantity);
        }

        return $taxAmount;
    }
}
