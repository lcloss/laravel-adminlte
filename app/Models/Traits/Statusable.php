<?php

namespace App\Models\Traits;

trait Statusable
{
    /**
     * Assign to every model before it was inserted.
     */
    public static function bootStatusable()
    {
    }

    public function getStatusAttribute($value)
    {
        return __(config('constants.status.' . $value));
    }

    /**
     * Get Status list
     *
     * @return array
     */
    public static function getStatuses()
    {
        $statuses = [];
        $statuses[''] = __('global.pleaseSelect');
        foreach( \Config::get('constants.status') as $code => $value ) {
            $statuses[$code] = __($value);
        }
        return $statuses;
    }
}

