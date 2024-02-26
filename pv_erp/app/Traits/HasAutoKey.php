<?php

namespace App\Traits;

trait HasAutoKey {
    protected static function bootHasAutoKey()
    {
        static::creating(function ($model) {
            do {
                $uuid = uniqid("a");
            } while (static::where('auto_key', $uuid)->first());
            $model->auto_key = $uuid;
        });

        static::saving(function ($model) {
            // Preventing from creating new UUID for existing records
            $original_uuid = $model->getOriginal('auto_key');
    
            if ($original_uuid !== $model->auto_key) {
                // $model->auto_key = $original_uuid;
                // return error message
            }
        });
    }
}