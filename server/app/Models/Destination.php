<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;


    protected $fillable = [
        "title",
        "price",
        "slug",
        "openTime",
        "closeTime",
        "access",
        "address",
        "numberPhone",
        "image",
        "region_id",
        "business_id",
        "category_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->hasMany(Category::class);
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
