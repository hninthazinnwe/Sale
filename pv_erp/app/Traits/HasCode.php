<?php

namespace App\Traits;

trait HasCode {
    protected static function bootHasCode()
    {
        static::creating(function ($model) {

            $maxCount = static::withTrashed()->count();

            do {
                $serial_no = $maxCount + 1;
                if ($maxCount <= 999) {
                    $strPad = 4;
                } else if ($maxCount > 999) {
                    $strPad = 3;
                }
                try {
                        $model->code = str_pad($serial_no, $strPad, "0", STR_PAD_LEFT);
                    $status = false;
                } catch (\Exception $e) {
                    $status = true;
                }
                $maxCount++;
            } while ($status);

            // do {
            //     $uuid = uniqid("a");
            // } while (static::where('uuid', $uuid)->first());
            // $model->uuid = $uuid;
        });

        static::saving(function ($model) {
            // Preventing from creating new UUID for existing records
            $original_uuid = $model->getOriginal('code');
    
            if ($original_uuid !== $model->code) {
                $model->code = $original_uuid;
            }
        });
    }
}