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
