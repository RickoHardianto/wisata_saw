<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'slug', 'image'
    ];

    public function destination()
    {
        return $this->hasMany(Destination::class , 'category_id' , 'id');
    }

    public function getImageAttribute($image)
    {
        return asset('storage/categories/' . $image);
    }
}
