<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category'; // Mantienes la referencia a la tabla
    protected $fillable = [
        'name',
        'description'
    ];

    // Relación con Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}

