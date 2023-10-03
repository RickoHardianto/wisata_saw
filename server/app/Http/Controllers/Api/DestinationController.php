<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Destination;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    
    public function index(){
        $destination = Destination::latest()->paginate(5);

        return new ApiResource(true, 'List Data Destination', $destination);
    }
}
