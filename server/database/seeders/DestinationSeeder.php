<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Facades\File;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/destination.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Destination::create(array(
                "wisata" => $obj->wisata,
                "price" => $obj->price,
                "openTime" => $obj->openTime,
                "closeTime" => $obj->closeTime,
                "access" => $obj->access,
                "address" => $obj->address,
                "kecamatan" => $obj->address,
                "numberPhone" => $obj->numberPhone,
                "img" => $obj->img,
                "img_lokasi" => $obj->img_lokasi,
                "region_id" => $obj->region_id,
                "business_id" => $obj->business_id,
                "category_id" => $obj->category_id
            ));
        }
    }
}
