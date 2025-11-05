<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'tbl_sales';

    protected $fillable = [
        'car_id',
        'buyer_name',
        'price',
        'sale_date'
    ];

    protected $casts = [
        'sale_date' => 'datetime',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
