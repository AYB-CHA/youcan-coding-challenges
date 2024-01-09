<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'category_id', 'created_at', 'updated_at'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
