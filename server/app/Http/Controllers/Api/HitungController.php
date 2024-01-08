<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class HitungController extends Controller
{

    public function hitung(Request $request){

        $kriteria = Kriteria::sum('bobot');

        $bobot1 = 3/$kriteria;
        $bobot2 = 2/$kriteria;
        $bobot3 = 2/$kriteria;
        $bobot4 = 2/$kriteria;
        $bobot5 = 1/$kriteria;
        $widget1 = [
            'kriterias' => $bobot1,
        ];
        $widget2 = [
            'kriterias' => $bobot2,
        ];
        $widget3 = [
            'kriterias' => $bobot3,
        ];
        $widget4 = [
            'kriterias' => $bobot4,
        ];
        $widget5 = [
            'kriterias' => $bobot5,
        ];


        $alternatif = Alternatif::get();
        $data = alternatif::orderby('nama', 'asc')->get();

        $minC1 = Alternatif::min('C1');
        $maxC1 = Alternatif::max('C1');
        $minC2 = Alternatif::min('C2');
        $maxC2 = Alternatif::max('C2');
        $minC3 = Alternatif::min('C3');
        $maxC3 = Alternatif::max('C3');
        $minC4 = Alternatif::min('C4');
        $maxC4 = Alternatif::max('C4');
        $minC5 = Alternatif::min('C5');
        $maxC5 = Alternatif::max('C5');

        $C1min =[
            'alternatifs' => $minC1,
        ];
        $C1max =[
            'alternatifs' => $maxC1,
        ];
        $C2min =[
            'alternatifs' => $minC2,
        ];
        $C2max =[
            'alternatifs' => $maxC2,
        ];
        $C3min =[
            'alternatifs' => $minC3,
        ];
        $C3max =[
            'alternatifs' => $maxC3,
        ];
        $C4min =[
            'alternatifs' => $minC4,
        ];
        $C4max =[
            'alternatifs' => $maxC4,
        ];
        $C5min =[
            'alternatifs' => $minC5,
        ];
        $C5max =[
            'alternatifs' => $maxC5,
        ];

        $hasil = $minC1/$maxC1;
        $hasil1 =[
            'alternatifs' => $hasil,
        ];

        $responseData = [
            'hasil1'  => $hasil1,
            'data'    => $data,
            'widget1' => $widget1,
            'widget2' => $widget2,
            'widget3' => $widget3,
            'widget4' => $widget4,
            'widget5' => $widget5,
            'C1min'   => $C1min,
            'C1max'   => $C1max,
            'C2min'   => $C2min,
            'C2max'   => $C2max,
            'C3min'   => $C3min,
            'C3max'   => $C3max,
            'C4min'   => $C4min,
            'C4max'   => $C4max,
            'C5min'   => $C5min,
            'C5max'   => $C5max,
        ];

        return response()->json($responseData, 200);
    }
}
