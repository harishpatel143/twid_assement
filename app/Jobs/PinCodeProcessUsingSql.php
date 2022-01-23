<?php

namespace App\Jobs;

use App\Models\PinCode;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class PinCodeProcessUsingSql extends Job
{
    use Batchable, InteractsWithQueue,Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $url = 'http://data.gov.in/sites/default/files/all_india_pin_code.csv';
        $filePath = public_path('pin_code.csv');
        $contents = file_get_contents($url);
        file_put_contents($filePath, $contents);
        $pdo = DB::connection()->getPdo();
        $filePath = addslashes($filePath);

//        $sql = "CREATE TEMPORARY TABLE temporary_table SELECT * FROM pin_codes WHERE 1=0;";
//
//        $sql .= "LOAD DATA INFILE '$filePath'
//                IGNORE
//                INTO TABLE temporary_table
//                CHARACTER SET latin1
//                FIELDS TERMINATED BY ','
//                ENCLOSED BY '\"'
//                ESCAPED BY '\"'
//                LINES TERMINATED BY ''
//                IGNORE 1 lines
//                (id,officename,pincode,officeType,Deliverystatus,divisionname,regionname,circlename,Taluk,Districtname,statename);";
//
//        $sql .= "SHOW COLUMNS FROM pin_codes;
//                INSERT INTO pin_codes
//                SELECT * FROM temporary_table
//                ON DUPLICATE KEY UPDATE
//                    officename = VALUES(officename),
//                    pincode = VALUES(pincode),
//                    officeType = VALUES(officeType),
//                    Deliverystatus = VALUES(Deliverystatus),
//                    divisionname = VALUES(divisionname),
//                    regionname = VALUES(regionname),
//                    circlename = VALUES(circlename),
//                    Taluk = VALUES(Taluk),
//                    statename = VALUES(statename);";
//
//        $sql .= "DROP TEMPORARY TABLE temporary_table;";

        $sql = "LOAD DATA LOCAL INFILE '$filePath'
                REPLACE
                INTO TABLE pin_codes
                CHARACTER SET latin1
                FIELDS TERMINATED BY ','
                ENCLOSED BY '\"'
                ESCAPED BY '\"'
                LINES TERMINATED BY '\n'
                IGNORE 1 lines
                (officename,pincode,officeType,Deliverystatus,divisionname,regionname,circlename,Taluk,Districtname,statename)
                SET created_at=NOW(),updated_at=NOW();";

        $pdo->exec($sql);
        unlink($filePath);//Remove temp file
    }
}
