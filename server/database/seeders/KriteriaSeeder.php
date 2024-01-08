<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $json = File::get('database/data/kriteria.json');
        $data = json_decode($json);
        foreach ($data as $obj){
            Kriteria::create(array(
                'nama' => $obj->nama,
                'bobot' => $obj->bobot,
                'atribut' => $obj->atribut,
            ));
        }
    }
}
