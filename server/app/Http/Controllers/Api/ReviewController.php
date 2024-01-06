<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {

        //check review already
        $review = Review::where('destination_id', $request->destination_id);
        
        $review = Review::create([
            'destination_id' => $request->destination_id,
            'nama' => $request->nama,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        if ($review) {
            //return success with Api Resource
            return new ApiResource(true, 'Data Review Berhasil Disimpan!', $review);
        }
        //return failed with Api Resource
        return new ApiResource( false, 'Data Review Gagal Disimpan!', null);
    }
}
