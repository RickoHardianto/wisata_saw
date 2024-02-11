<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Kriteria;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $totalDestinations = Destination::count();
        $totalCategories = Category::count();
        $totalRegions = Region::count();
        $validasiDestinations = Destination::where('status', 'Validasi')->count();
        $businessDestination =  Business::select('business', DB::raw('COUNT(destinations.id) as total_destinations'))
            ->leftJoin('destinations', 'businesses.id', '=', 'destinations.business_id')
            ->groupBy('businesses.id', 'businesses.business')
            ->get();

        $kriteria = Kriteria::get();

        return response()->json([
            'total_destinations' => $totalDestinations,
            'total_categories' => $totalCategories,
            'total_regions' => $totalRegions,
            'validasi_destination' => $validasiDestinations,
            'business_destination' => $businessDestination,
            'kriteria' => $kriteria,
        ]);
    }
}
