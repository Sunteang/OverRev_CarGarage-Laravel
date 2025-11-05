<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'tbl_cars';

    protected $fillable = [
        'make',
        'model',
        'year',
        'description',
        'color',
        'mileage',
        'status',
        'car_type',
        'price_per_day',
        'sale_price',
    ];

    // Relationships
    public function images()
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }
    public function rentals()
    {
        return $this->hasMany(Rental::class, 'car_id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'car_id');
    }
    public function repairs()
    {
        return $this->hasMany(Repair::class, 'car_id');
    }

    // Helper: first image for thumbnail
    public function getThumbnailAttribute()
    {
        return $this->images()->first()?->image_path;
    }

    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'tbl_favourites', 'car_id', 'user_id')->withTimestamps();
    }
}
