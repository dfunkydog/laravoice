<?php

use Carbon\Carbon;

if (!function_exists('getMonth')) {
    function getMonth($date = null): array
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
