<?php
declare(strict_types=1);

namespace Bassix\Finance\Helper;

class TaxCalculatorHelper extends MathHelper
{
    /**
     * Method calculates the net price from the gross price using the transferred tax rate and the transferred decimal places.
     *
     * Net price = gross price - taxes
     *
     * Original calculation:
     * net = gross / (1 + tax rate / 100);
     *
     * Example for 19%
     * net = gross / 1,19
     *
     * @param float|string $grossAmount
     * @param float        $taxRate
     * @param int          $precision Integer or 0 for precession for rounding and -1 to disable rounding!
     * @return string
     */
    public static function getNetPriceFromGross($grossAmount, $taxRate, $precision = 4): string
    {
        $netAmount = bcdiv((string)$grossAmount, bcadd('1', bcdiv((string)$taxRate, '100', parent::getPrecisionInternal($precision)), parent::getPrecisionInternal($precision)), parent::getPrecisionInternal($precision));

        return MathHelper::bcRound($netAmount, $precision);
    }

    /**
     * Method calculates the tax included in the gross price using the net price and the transferred tax rate and the transferred decimal places.
     *
     * taxes = gross price - net price
     * tax = (price x tax rate) : (100 + tax rate)
     *
     * Original calculation:
     * $taxPortion = ($grossPrice * $taxRate) / (100 + $taxRate);
     *
     * Example for 19%
     * tax rate 19.0: tax cost = (gross * 19) : 119
     *
     * @param float|string $grossAmount
     * @param float        $taxRate
     * @param int          $precision Integer or 0 for precession for rounding and -1 to disable rounding!
     * @return string
     */
    public static function getTaxCostFromGross($grossAmount, $taxRate, $precision = 4): string
    {
        if (0 === bccomp((string)$taxRate, '0.0')) {
            return '0.0';
        }

        $taxAmount = bcdiv(
            bcmul((string)$grossAmount, (string)$taxRate, parent::getPrecisionInternal($precision)),
            bcadd('100', (string)$taxRate, parent::getPrecisionInternal($precision)),
            parent::getPrecisionInternal($precision)
        );

        return MathHelper::bcRound($taxAmount, $precision);
    }
}
