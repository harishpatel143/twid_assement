<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FetchPinCodeDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pincode:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Pin Code data from URL and store in CSV file. After storing insert into database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = 'http://data.gov.in/sites/default/files/all_india_pin_code.csv';
        $filePath = storage_path('pin_code.csv');
        $contents = file_get_contents($url);
        file_put_contents($filePath, $contents);
        $this->info('Stored details in temp file');

        $pdo = DB::connection()->getPdo();
        $filePath = addslashes(public_path('pin_code.csv'));

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
        $this->info('Data has been Processed');
        unlink($filePath);//Remove temp file
    }
}
