<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'price', 'brand_id', 'model', 'mileage', 'transmission'];

    public function carImages()
    {
        return $this->hasMany(CarImage::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
