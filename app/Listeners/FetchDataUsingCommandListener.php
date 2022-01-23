<?php

namespace App\Listeners;

use App\Events\FetchDataEvent;
use App\Jobs\PinCodeProcess;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;

class FetchDataUsingCommandListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        Log::info('listener');
    }

    /**
     * Handle the event.
     *
     * @param FetchDataEvent $event
     * @return \Illuminate\Bus\Batch
     * @throws \Throwable
     */
    public function handle(FetchDataEvent $event)
    {
        Artisan::call('pincode:fetch');
    }
}
