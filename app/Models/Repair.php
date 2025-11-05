<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $table = 'tbl_repairs';

    protected $fillable = [
        'car_id',
        'description',
        'cost',
        'repair_date',
        'status',
    ];

    protected $casts = [
        'repair_date' => 'datetime',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
