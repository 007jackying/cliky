<?php

namespace App\Console\Commands;

use App\Models\Availability;
use App\Models\Department;
use App\Models\Retailer;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Reader\Exception\ReaderNotOpenedException;
use Illuminate\Console\Command;
use DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Validator;
use Config;
use App\Models\Temp;
use App\Models\Offer;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Flag;

class ImportManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This import tool will import csv file information to Table';
    protected $chunkSize = 100;

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
        ini_set('max_execution_time', 180);
        $sleeper = 100;

        ini_set('memory_limit', '768M');

        $file = Flag::where('imported','=','0')->orderBy('created_at','DESC')->first();

        $file_path = Config::get('filesystems.disks.local.root').'/'.$file->file_name;

//        $offer_lists = $this->csvToArray($file_path);
//
//        Retailer::store(array_unique(array_column($offer_lists, 'retailer')));
//        Department::store(array_unique(array_column($offer_lists,'dept')));
//        Availability::store(array_unique(array_column($offer_lists, 'update_type')));
//
        $retailers = Retailer::getArray();
        $departments = Department::getArray();
        $availability = Availability::getArray();

        try {
            $temporary = (new FastExcel)->configureCsv(',', '#')->import($file_path, function ($line) use ($availability, $retailers, $departments, $file) {
                return Offer::create([
                    'availability_id' => array_search($line['update_type'], $availability),
                    'date'            => date('Y-m-d', strtotime($line['update_date'])),
                    'date_code'       => htmlspecialchars($line['date_code']),
                    'retailer_id'     => array_search($line['retailer'], $retailers),
                    'product'         => htmlspecialchars($line['product']),
                    'current_price'   => htmlspecialchars($line['now']),
                    'discount_offer'  => htmlspecialchars($line['off']),
                    'image_url'       => htmlspecialchars($line['image_url']),
                    'department_id'   => array_search($line['dept'], $departments),
                    'category'        => htmlspecialchars($line['category']),
                    'offer_url'       => htmlspecialchars($line['url']),
                ]);
            });

        } catch (IOException $e) {
        } catch (UnsupportedTypeException $e) {
        } catch (ReaderNotOpenedException $e) {
        }
        //print_r($temporary);

        /*$temp = (new FastExcel)->import($file_path, function($line){
            $tmp = Temp::create([
                'availability_id' => htmlspecialchars($line['update_type']),,
                'date'     => htmlspecialchars($line['update_date']),,
                'date_code'       => htmlspecialchars($line['date_code']),
                'retailer_id'     => htmlspecialchars($line['retailer']),,
                'product'         => htmlspecialchars($line['product']),
                'current_price'   => htmlspecialchars($line['now']),
                'discount_offer'  => htmlspecialchars($line['off']),
                'image_url'       => htmlspecialchars($line['image_url']),
                'department_id'   => htmlspecialchars($line['dept']),,
                'category'        => htmlspecialchars($line['category']),
                'offer_url'       => htmlspecialchars($line['url']),
            ]);
        });*/

        /*

        $offer_list_chunk = array_chunk($offer_lists, 700);
        $counter = 0;
        for($i = 0; $i<sizeof($offer_list_chunk); $i++) {
            foreach ($offer_list_chunk[$i] as $key => $row) {
                $counter++;
                $offer = Offer::create([
                    'availability_id' => array_search($row['update_type'], $availability),
                    'date'     => date('Y-m-d', strtotime($row['update_date'])),
                    'date_code'       => htmlspecialchars($row['date_code']),
                    'retailer_id'     => array_search($row['retailer'], $retailers),
                    'product'         => htmlspecialchars($row['product']),
                    'current_price'   => htmlspecialchars($row['now']),
                    'discount_offer'  => htmlspecialchars($row['off']),
                    'image_url'       => htmlspecialchars($row['image_url']),
                    'department_id'   => array_search($row['dept'], $departments),
                    'category'        => htmlspecialchars($row['category']),
                    'offer_url'       => htmlspecialchars($row['url']),

                ]);

                $offer->save();
                $file = $file->fresh();
                $file->rows_imported = $counter;
                $file->save();
            }
            sleep($sleeper);
        }
        $file = $file->fresh();
        $file->imported = 1;
        $file->save();*/


        /*Excel::load($file_path, function($reader) use($file) {
            $objWorksheet = $reader->getActiveSheet();
            $file->total_rows = $objWorksheet->getHighestRow() - 1; //exclude the heading
            $file->save();
        });

        Excel::filter('chunk')
            ->selectSheetsByIndex(0)
            ->load($file_path)
            ->chunk($this->chunkSize, function($result) use ($file) {
                $rows = $result->toArray();
                //let's do more processing (change values in cells) here as needed
                $counter = 0;
                foreach ($rows as $k => $row) {
                    $offer = Offer::create([
                        'update_type' => $row['update_type'],
                        'update_date' => $row['update_date'],
                        'date_code'   => $row['date_code'],
                        'retailer'    => $row['retailer'],
                        'product'     => $row['product'],
                        'now'         => $row['now'],
                        'off'         => $row['off'],
                        'image_url'   => $row['image_url'],
                        'dept'        => $row['dept'],
                        'category'    => $row['category'],
                        'url'         => $row['url'],

                    ]);

                    $offer->save();
                }
                $file = $file->fresh(); //reload from the database
                $file->rows_imported = $file->rows_imported + $counter;
                $file->save();


            }
            );

        $file->imported =1;
        $file->save();*/
        return true;
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 25000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }


}
