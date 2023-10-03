<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Destination;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{

    public function index()
    {
        $destination = Destination::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List data Destination',
            'data' => $destination
        ], 200);
    }
}
