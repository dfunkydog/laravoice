<?php

use Carbon\Carbon;

if (!function_exists('getPeriod')) {
    function getPeriod($date = null): array
    {
        $targetDate = $date ? new Carbon($date) : new Carbon();
        $start = new Carbon($targetDate->startOfMonth());
        $end = new Carbon($targetDate->endOfMonth());

        return [$start, $end];
    }
}

if (!function_exists('money')) {
    function money(float $amount): string
    {
        $formatted = number_format($amount, 2);

        return '<sup>£</sup>' . $formatted;
    }
}

if (! function_exists('str_ordinal')) {
    /**
     * Append an ordinal indicator to a numeric value.
     *
     * @param  string|int  $value
     * @param  bool  $superscript
     * @return string
     */
    function str_ordinal($value, $superscript = false)
    {
        $number = abs($value);

        $indicators = ['th','st','nd','rd','th','th','th','th','th','th'];

        $suffix = $superscript ? '<sup>' . $indicators[$number % 10] . '</sup>' : $indicators[$number % 10];
        if ($number % 100 >= 11 && $number % 100 <= 13) {
            $suffix = $superscript ? '<sup>th</sup>' : 'th';
        }

        return number_format($number) . $suffix;
    }
}
