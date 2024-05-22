<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Favoriteable, Sortable;

    public function category()
     {
         return $this->belongsTo(Category::class);
     }

     public function reviews()
     {
         return $this->hasMany(Review::class);
     }

     public function favorites() {
        return $this->hasMany(Review::class);
    }
}
