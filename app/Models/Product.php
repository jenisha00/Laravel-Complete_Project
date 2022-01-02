<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'quantity',
        'unit_price',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function sale(){
        return $this->hasMany(Sale::class);
    }

    public function stock(){
        return $this->hasMany(Stock::class);
    } 
}

