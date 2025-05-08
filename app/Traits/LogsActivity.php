<?php

namespace App\Traits;

use App\Observers\ActivityLogObserver;

trait LogsActivity
{
    /**
     * Boot the trait.
     */
    public static function bootLogsActivity()
    {
        static::observe(ActivityLogObserver::class);
    }
}
