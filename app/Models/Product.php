<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //Define the fillable fields for mass assignment
    protected $fillable = ['name', 'price', 'quantity'];


    //Define the relationship between the product and the category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
