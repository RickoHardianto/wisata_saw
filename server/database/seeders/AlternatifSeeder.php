<?php

namespace Database\Seeders;

use App\Models\alternatif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $json = File::get('database/data/alternatif.json');
        $data = json_decode($json);
        foreach ($data as $obj){
            alternatif::create(array(
                'nama' => $obj->nama,
                'C1' => $obj->C1,
                'C2' => $obj->C2,
                'C3' => $obj->C3,
                'C4' => $obj->C4,
                'C5' => $obj->C5
            ));
        }
    }
}
