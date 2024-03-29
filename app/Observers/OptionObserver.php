<?php

namespace App\Observers;

use App\Models\option;

class OptionObserver
{
    /**
     * Handle the option "created" event.
     *
     * @param  \App\Models\option  $option
     * @return void
     */
    public function created(option $option)
    {
        redisRemover($option->key);
    }

    /**
     * Handle the option "updated" event.
     *
     * @param  \App\Models\option  $option
     * @return void
     */
    public function updated(option $option)
    {
        redisRemover($option->key );
    }

    /**
     * Handle the option "deleted" event.
     *
     * @param  \App\Models\option  $option
     * @return void
     */
    public function deleted(option $option)
    {
        redisRemover($option->key );
    }

    /**
     * Handle the option "restored" event.
     *
     * @param  \App\Models\option  $option
     * @return void
     */
    public function restored(option $option)
    {
        redisRemover( $option->key );
    }

    /**
     * Handle the option "force deleted" event.
     *
     * @param  \App\Models\option  $option
     * @return void
     */
    public function forceDeleted(option $option)
    {
        redisRemover($option->key );
    }
}
