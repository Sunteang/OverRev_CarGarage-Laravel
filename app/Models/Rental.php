<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'tbl_rentals';

    protected $fillable = [
        'car_id',
        'customer_name',
        'rent_date',
        'return_date',
        'total_price'
    ];

    protected $casts = [
        'rent_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
