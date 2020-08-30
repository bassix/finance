<?php
declare(strict_types=1);

namespace Bassix\Finance\Helper;

use Bassix\Finance\Exceptions\InvalidFloatFormatException;

class MathHelper
{
    /**
     * Scale used for all calculations.
     *
     * @var int bcscale argument
     */
    public const BCSCALE = 4;

    public static function toInt($number, $absolute = false): int
    {
        if (false !== strpos((string)$number, ',')) {
            $number = str_replace(',', '.', $number);
            $number = (float)$number;
        }

        if (is_float($number)) {
            $number = self::bcRound($number, 0);
        }

        if (true === $absolute) {
            $number = abs($number);
        }

        $number = (int)(string)$number;

        return $number;
    }

    public static function toFloat($number = 0.0): float
    {
        if (false !== strpos($number, ',')) {
            $number = str_replace(',', '', $number);
        }

        return (float)abs($number);
    }

    public static function bcCeil($number): string
    {
        if (false !== strpos($number, '.')) {
            if (preg_match("~\.[0]+$~", $number)) {
                return self::bcRound($number, 0);
            }
            if ('-' !== $number[0]) {
                return bcadd((string)$number, '1', 0);
            }

            return bcsub($number, '0', 0);
        }

        return $number;
    }

    public static function bcFloor($number): string
    {
        if (false !== strpos($number, '.')) {
            if (preg_match("~\.[0]+$~", $number)) {
                return MathHelper::bcRound($number, 0);
            }

            if ('-' !== $number[0]) {
                return bcadd((string)$number, '0', 0);
            }

            return bcsub((string)$number, '1', 0);
        }

        return $number;
    }

    /**
     * Rounds a bc-string-value half up
     *
     * BC MATH (Binary Calculator - numbers of any size and precision, represented as strings)
     *
     * $number = '120.00';  bcround($number, 2) = 120.00;
     * $number = '120.5555';  bcround($number, 2) = 120.56;
     * $number = '120,5555';  bcround($number, 2) = 120.56;
     *
     * @param string $number    np 120.00, 120.5555, 10,9989393
     * @param int    $precision (default:0)
     */
    public static function bcRound($number, $precision = 4): string
    {
        try {
            self::expectNumberIsUsableAsFloat($number);
        } catch (InvalidFloatFormatException $e) {
            trigger_error($e->getCode() . ' :: ' . $e->getMessage(), E_USER_WARNING);
            $number = '0.0';
        }

        if ('double' === gettype($number)) {
            $number = (string)$number;
        }

        if (false !== strpos($number, '.')) {
            if ('-' !== $number[0]) {
                return bcadd($number, '0.' . str_repeat('0', $precision) . '5', $precision);
            }

            return bcsub($number, '0.' . str_repeat('0', $precision) . '5', $precision);
        }

        return $number;
    }

    /**
     * Method to compare the left and the right value and deliver a integer as the result:
     *
     * - returns 0 if the both values are equal
     * - returns 1 if the left operator is greater
     * - returns -1 if the right operator is greater
     *
     * @param number|string $amountLeft
     * @param number|string $amountRight
     * @param int|string    $precision
     */
    public static function bcComp($amountLeft, $amountRight, $precision = 4): int
    {
        return bccomp($amountLeft, $amountRight, $precision);
    }

    /**
     * @param number|string $amount
     * @param int|string    $precision
     */
    public static function bcCompZero($amount, $precision = 4): int
    {
        $amount = MathHelper::bcRound($amount, $precision);

        if ('-' === @$amount[0]) {
            return bccomp($amount, '-0.0', $precision);
        }

        return bccomp($amount, '0.0', $precision);
    }

    /**
     * Method to check if the given string or number is usable as a float value.
     *
     * @param number|string $number
     */
    public static function numberCanBeUsedAsFloat($number): bool
    {
        if (is_float($number)) {
            return true;
        }

        return (bool)preg_match('/^-?(?:\d+|\d*\.\d*)$/', $number);
    }

    /**
     * Method to expect and to check if the given string or number is usable as a float value.
     *
     * @param number|string $number
     * @throws InvalidFloatFormatException
     */
    public static function expectNumberIsUsableAsFloat($number): void
    {
        if (true !== self::numberCanBeUsedAsFloat($number)) {
            throw new InvalidFloatFormatException(
                "The given string or number \"{$number}\" is not a valid working boolean value!"
            );
        }
    }

    /**
     * Get float from string
     *
     * @param string $string
     */
    public static function getFloat($string): float
    {
        if (false !== strpos($string, ',')) {
            // replace dots (thousand seps) with blancs
            $string = str_replace(['.', ','], ['', '.'], $string); // replace ',' with '.'
        }

        if (preg_match("#([0-9\.]+)#", $string, $match)) { // search for number that may contain '.'
            return (float)$match[0];
        }

        return (float)$string;
    }

    /**
     * Method to get the internal precision.
     *
     * @param int $precision
     */
    protected static function getPrecisionInternal($precision = 4): int
    {
        $precision = (int)$precision;

        return $precision >= 0 ? ($precision + 2) : self::BCSCALE + 2;
    }
}
