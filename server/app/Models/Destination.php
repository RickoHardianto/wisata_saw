<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;


    protected $fillable = [
        "wisata",
        "deskripsi",
        "price",
        "penginapan",
        "jarak",
        "openTime",
        "closeTime",
        "access",
        "address",
        "kecamatan",
        "numberPhone",
        "img",
        "img_lokasi",
        "region_id",
        "business_id",
        "category_id",
        "user_id",
        "status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }

    public function business()
    {
        return $this->hasMany(Business::class);
    }

    public function region()
    {
        return $this->hasMany(Region::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getImageAttribute($image)
    {
        return asset('storage/destination/' . $image);
    }

    public function getReviewsAvgRatingAttribute($value)
    {
        return $value ? substr($value, 0, 3) : 0;
    }
}
