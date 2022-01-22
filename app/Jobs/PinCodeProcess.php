<?php

namespace App\Jobs;

use App\Models\PinCode;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PinCodeProcess extends Job
{
    use Batchable, InteractsWithQueue, Queueable, SerializesModels;

    public $header;
    public $data;

    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    public function handle()
    {
        foreach ($this->data as $pinCode) {
            $pinCodeDetails = array_combine($this->header,$pinCode);
            PinCode::updateOrcreate($pinCodeDetails,$pinCodeDetails);
        }
    }
}
