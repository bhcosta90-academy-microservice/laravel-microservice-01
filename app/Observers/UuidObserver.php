<?php

namespace App\Observers;

use Illuminate\Support\Str;

class UuidObserver
{
    /**
     * Handle the \Illuminate\Database\Eloquent\Model "created" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $obj
     * @return void
     */
    public function creating(\Illuminate\Database\Eloquent\Model $obj)
    {
        $obj->uuid = Str::uuid();
    }
}
