<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Define the fillable fields for mass assignment
    protected $fillable = ['name'];

    //Define the relationship between the category and the products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
