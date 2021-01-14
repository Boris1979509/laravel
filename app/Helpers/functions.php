<?php
if (!function_exists('numberFormat')) {
    /**
     * @param float $price
     * @param null|string $unit
     * @return string
     */
    function numberFormat($price, $unit = '&#8381;'): string
    {
        $value = number_format($price, 2, '.', ' ');
        $value = str_replace('.00', '', $value);

        if (!is_null($unit)) {
            $value .= ' ' . $unit;
        }
        return $value;
    }
}
