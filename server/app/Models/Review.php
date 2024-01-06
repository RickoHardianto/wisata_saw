<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama','rating', 'review', 'destination_id', 'customer_id'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
