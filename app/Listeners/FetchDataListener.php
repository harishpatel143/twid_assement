<?php

namespace App\Listeners;

use App\Events\FetchDataEvent;
use App\Jobs\PinCodeProcess;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;

class FetchDataListener implements ShouldQueue
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
        $url = 'http://data.gov.in/sites/default/files/all_india_pin_code.csv';
        $filePath = public_path('pin_code.csv');
        $contents = file_get_contents($url);

        file_put_contents($filePath, $contents);
        $chunks = array_chunk(file($filePath),1000);
        $header = [];
        $batch  = Bus::batch([])->dispatch();

        foreach ($chunks as $key => $chunk) {
            $data = array_map(function ($row) {
                return str_getcsv(iconv('WINDOWS-1252', 'UTF-8', $row));
            }, $chunk);
            if($key == 0){
                $header = $data[0];
                unset($data[0]);
            }
            $batch->add(new PinCodeProcess($data, $header));
        }
        unlink($filePath);
    }
}
