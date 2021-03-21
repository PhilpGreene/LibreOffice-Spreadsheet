<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Financial;

use PhpOffice\PhpSpreadsheet\Calculation\DateTime;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Securities
{
    public const FREQUENCY_ANNUAL = 1;
    public const FREQUENCY_SEMI_ANNUAL = 2;
    public const FREQUENCY_QUARTERLY = 4;

    /**
     * PRICE.
     *
     * Returns the price per $100 face value of a security that pays periodic interest.
     *
     * @param mixed $settlement The security's settlement date.
     *                              The security settlement date is the date after the issue date when the security
     *                              is traded to the buyer.
     * @param mixed $maturity The security's maturity date.
     *                                The maturity date is the date when the security expires.
     * @param float $rate the security's annual coupon rate
     * @param float $yield the security's annual yield
     * @param float $redemption The number of coupon payments per year.
     *                              For annual payments, frequency = 1;
     *                              for semiannual, frequency = 2;
     *                              for quarterly, frequency = 4.
     * @param int $frequency
     * @param int $basis The type of day count to use.
     *                       0 or omitted    US (NASD) 30/360
     *                       1                Actual/actual
     *                       2                Actual/360
     *                       3                Actual/365
     *                       4                European 30/360
     *
     * @return float|string Result, or a string containing an error
     */
    public static function price($settlement, $maturity, $rate, $yield, $redemption, $frequency, $basis = 0)
    {
        $settlement = Functions::flattenSingleValue($settlement);
        $maturity = Functions::flattenSingleValue($maturity);
        $rate = Functions::flattenSingleValue($rate);
        $yield = Functions::flattenSingleValue($yield);
        $redemption = Functions::flattenSingleValue($redemption);
        $frequency = Functions::flattenSingleValue($frequency);
        $basis = Functions::flattenSingleValue($basis);

        try {
            $settlement = self::validateSettlementDate($settlement);
            $maturity = self::validateMaturityDate($maturity);
            self::validateSecurityPeriod($settlement, $maturity);
            $rate = self::validateRate($rate);
            $yield = self::validateYield($yield);
            $redemption = self::validateRedemption($redemption);
            $frequency = self::validateFrequency($frequency);
            $basis = self::validateBasis($basis);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $dsc = Coupons::COUPDAYSNC($settlement, $maturity, $frequency, $basis);
        $e = Coupons::COUPDAYS($settlement, $maturity, $frequency, $basis);
        $n = Coupons::COUPNUM($settlement, $maturity, $frequency, $basis);
        $a = Coupons::COUPDAYBS($settlement, $maturity, $frequency, $basis);

        $baseYF = 1.0 + ($yield / $frequency);
        $rfp = 100 * ($rate / $frequency);
        $de = $dsc / $e;

        $result = $redemption / $baseYF ** (--$n + $de);
        for ($k = 0; $k <= $n; ++$k) {
            $result += $rfp / ($baseYF ** ($k + $de));
        }
        $result -= $rfp * ($a / $e);

        return $result;
    }

    /**
     * PRICEDISC.
     *
     * Returns the price per $100 face value of a discounted security.
     *
     * @param mixed $settlement The security's settlement date.
     *                              The security settlement date is the date after the issue date when the security
     *                              is traded to the buyer.
     * @param mixed $maturity The security's maturity date.
     *                                The maturity date is the date when the security expires.
     * @param float $discount The security's discount rate
     * @param float $redemption The security's redemption value per $100 face value
     * @param int $basis The type of day count to use.
     *                                        0 or omitted    US (NASD) 30/360
     *                                        1                Actual/actual
     *                                        2                Actual/360
     *                                        3                Actual/365
     *                                        4                European 30/360
     *
     * @return float|string Result, or a string containing an error
     */
    public static function discounted($settlement, $maturity, $discount, $redemption, $basis = 0)
    {
        $settlement = Functions::flattenSingleValue($settlement);
        $maturity = Functions::flattenSingleValue($maturity);
        $discount = Functions::flattenSingleValue($discount);
        $redemption = Functions::flattenSingleValue($redemption);
        $basis = Functions::flattenSingleValue($basis);

        try {
            $settlement = self::validateSettlementDate($settlement);
            $maturity = self::validateMaturityDate($maturity);
            self::validateSecurityPeriod($settlement, $maturity);
            $discount = self::validateDiscount($discount);
            $redemption = self::validateRedemption($redemption);
            $basis = self::validateBasis($basis);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $daysBetweenSettlementAndMaturity = DateTime::YEARFRAC($settlement, $maturity, $basis);
        if (!is_numeric($daysBetweenSettlementAndMaturity)) {
            //    return date error
            return $daysBetweenSettlementAndMaturity;
        }

        return $redemption * (1 - $discount * $daysBetweenSettlementAndMaturity);
    }

    /**
     * PRICEMAT.
     *
     * Returns the price per $100 face value of a security that pays interest at maturity.
     *
     * @param mixed $settlement The security's settlement date.
     *                              The security's settlement date is the date after the issue date when the
     *                              security is traded to the buyer.
     * @param mixed $maturity The security's maturity date.
     *                                The maturity date is the date when the security expires.
     * @param mixed $issue The security's issue date
     * @param float $rate The security's interest rate at date of issue
     * @param float $yield The security's annual yield
     * @param int $basis The type of day count to use.
     *                                        0 or omitted    US (NASD) 30/360
     *                                        1                Actual/actual
     *                                        2                Actual/360
     *                                        3                Actual/365
     *                                        4                European 30/360
     *
     * @return float|string Result, or a string containing an error
     */
    public static function maturity($settlement, $maturity, $issue, $rate, $yield, $basis = 0)
    {
        $settlement = Functions::flattenSingleValue($settlement);
        $maturity = Functions::flattenSingleValue($maturity);
        $issue = Functions::flattenSingleValue($issue);
        $rate = Functions::flattenSingleValue($rate);
        $yield = Functions::flattenSingleValue($yield);
        $basis = Functions::flattenSingleValue($basis);

        try {
            $settlement = self::validateSettlementDate($settlement);
            $maturity = self::validateMaturityDate($maturity);
            self::validateSecurityPeriod($settlement, $maturity);
            $issue = self::validateIssueDate($issue);
            $rate = self::validateRate($rate);
            $yield = self::validateYield($yield);
            $basis = self::validateBasis($basis);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $daysPerYear = Helpers::daysPerYear(DateTime::YEAR($settlement), $basis);
        if (!is_numeric($daysPerYear)) {
            return $daysPerYear;
        }
        $daysBetweenIssueAndSettlement = DateTime::YEARFRAC($issue, $settlement, $basis);
        if (!is_numeric($daysBetweenIssueAndSettlement)) {
            //    return date error
            return $daysBetweenIssueAndSettlement;
        }
        $daysBetweenIssueAndSettlement *= $daysPerYear;
        $daysBetweenIssueAndMaturity = DateTime::YEARFRAC($issue, $maturity, $basis);
        if (!is_numeric($daysBetweenIssueAndMaturity)) {
            //    return date error
            return $daysBetweenIssueAndMaturity;
        }
        $daysBetweenIssueAndMaturity *= $daysPerYear;
        $daysBetweenSettlementAndMaturity = DateTime::YEARFRAC($settlement, $maturity, $basis);
        if (!is_numeric($daysBetweenSettlementAndMaturity)) {
            //    return date error
            return $daysBetweenSettlementAndMaturity;
        }
        $daysBetweenSettlementAndMaturity *= $daysPerYear;

        return (100 + (($daysBetweenIssueAndMaturity / $daysPerYear) * $rate * 100)) /
            (1 + (($daysBetweenSettlementAndMaturity / $daysPerYear) * $yield)) -
            (($daysBetweenIssueAndSettlement / $daysPerYear) * $rate * 100);
    }

    private static function validateInputDate($date)
    {
        $date = DateTime::getDateValue($date);
        if (is_string($date)) {
            throw new Exception(Functions::VALUE());
        }

        return $date;
    }

    private static function validateSettlementDate($settlement)
    {
        return self::validateInputDate($settlement);
    }

    private static function validateMaturityDate($maturity)
    {
        return self::validateInputDate($maturity);
    }

    private static function validateIssueDate($issue)
    {
        return self::validateInputDate($issue);
    }

    private static function validateSecurityPeriod($settlement, $maturity): void
    {
        if ($settlement >= $maturity) {
            throw new Exception(Functions::NAN());
        }
    }

    private static function validateRate($rate): float
    {
        if (!is_numeric($rate)) {
            throw new Exception(Functions::VALUE());
        }

        $rate = (float) $rate;
        if ($rate < 0.0) {
            throw new Exception(Functions::NAN());
        }

        return $rate;
    }

    private static function validateYield($yield): float
    {
        if (!is_numeric($yield)) {
            throw new Exception(Functions::VALUE());
        }

        $yield = (float) $yield;
        if ($yield < 0.0) {
            throw new Exception(Functions::NAN());
        }

        return $yield;
    }

    private static function validateRedemption($redemption): float
    {
        if (!is_numeric($redemption)) {
            throw new Exception(Functions::VALUE());
        }

        $redemption = (float) $redemption;
        if ($redemption <= 0.0) {
            throw new Exception(Functions::NAN());
        }

        return $redemption;
    }

    private static function validateDiscount($discount): float
    {
        if (!is_numeric($discount)) {
            throw new Exception(Functions::VALUE());
        }

        $discount = (float) $discount;
        if ($discount <= 0.0) {
            throw new Exception(Functions::NAN());
        }

        return $discount;
    }

    private static function validateFrequency($frequency): int
    {
        if (!is_numeric($frequency)) {
            throw new Exception(Functions::VALUE());
        }

        $frequency = (int) $frequency;
        if (
            ($frequency !== self::FREQUENCY_ANNUAL) &&
            ($frequency !== self::FREQUENCY_SEMI_ANNUAL) &&
            ($frequency !== self::FREQUENCY_QUARTERLY)
        ) {
            throw new Exception(Functions::NAN());
        }

        return $frequency;
    }

    private static function validateBasis($basis): int
    {
        if (!is_numeric($basis)) {
            throw new Exception(Functions::VALUE());
        }

        $basis = (int) $basis;
        if (($basis < 0) || ($basis > 4)) {
            throw new Exception(Functions::NAN());
        }

        return $basis;
    }
}