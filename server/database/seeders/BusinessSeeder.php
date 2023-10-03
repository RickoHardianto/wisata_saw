<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Business;
use Illuminate\Support\Facades\File;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/business.json');
        $data = json_decode($json);
        foreach ($data as $obj){
            Business::create(array(
                'business' => $obj->business
            ));
        }
    }
}
