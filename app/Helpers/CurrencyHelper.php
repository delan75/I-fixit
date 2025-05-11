<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Format a number as South African Rand (ZAR)
     *
     * @param float|int $amount The amount to format
     * @param bool $includeSymbol Whether to include the R symbol
     * @param int $decimals Number of decimal places
     * @return string
     */
    public static function formatZAR($amount, bool $includeSymbol = true, int $decimals = 2): string
    {
        // Format the number with the specified number of decimal places
        $formattedAmount = number_format($amount, $decimals, '.', ' ');
        
        // Add the R symbol if requested
        if ($includeSymbol) {
            return 'R ' . $formattedAmount;
        }
        
        return $formattedAmount;
    }
    
    /**
     * Format a number as South African Rand (ZAR) without decimal places if they are zeros
     *
     * @param float|int $amount The amount to format
     * @param bool $includeSymbol Whether to include the R symbol
     * @return string
     */
    public static function formatZARSmart($amount, bool $includeSymbol = true): string
    {
        // Check if the amount has decimal places
        if (floor($amount) == $amount) {
            // No decimal places needed
            return self::formatZAR($amount, $includeSymbol, 0);
        }
        
        return self::formatZAR($amount, $includeSymbol, 2);
    }
    
    /**
     * Parse a South African Rand (ZAR) formatted string back to a float
     *
     * @param string $formattedAmount The formatted amount (e.g., "R 1 234.56")
     * @return float
     */
    public static function parseZAR(string $formattedAmount): float
    {
        // Remove the R symbol and any spaces
        $cleanAmount = str_replace(['R', ' '], '', $formattedAmount);
        
        // Convert to float
        return (float) $cleanAmount;
    }
}
