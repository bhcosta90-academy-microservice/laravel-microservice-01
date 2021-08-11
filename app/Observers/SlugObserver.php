<?php

namespace App\Observers;

use Illuminate\Support\Str;

class SlugObserver
{
    /**
     * Handle the \Illuminate\Database\Eloquent\Model "created" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $obj
     * @return void
     */
    public function creating(\Illuminate\Database\Eloquent\Model $obj)
    {
        $obj->url = Str::slug($obj->title ?? $obj->name);
    }

    /**
     * Handle the \Illuminate\Database\Eloquent\Model "updated" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $obj
     * @return void
     */
    public function updating(\Illuminate\Database\Eloquent\Model $obj)
    {
        $obj->url = Str::slug($obj->title ?? $obj->name);
    }

    /**
     * Handle the \Illuminate\Database\Eloquent\Model "deleted" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $obj
     * @return void
     */
    public function deleted(\Illuminate\Database\Eloquent\Model $obj)
    {
        //
    }

    /**
     * Handle the \Illuminate\Database\Eloquent\Model "restored" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $obj
     * @return void
     */
    public function restored(\Illuminate\Database\Eloquent\Model $obj)
    {
        //
    }

    /**
     * Handle the \Illuminate\Database\Eloquent\Model "force deleted" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $obj
     * @return void
     */
    public function forceDeleted(\Illuminate\Database\Eloquent\Model $obj)
    {
        //
    }
}
