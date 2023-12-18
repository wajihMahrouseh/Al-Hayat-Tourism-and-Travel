<?php

namespace App\Models;

use App\Models\Journey;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;


    public function category()
    {
        $this->belongsTo(Category::class);
    }


    public function journeys()
    {
        $this->hasMany(Journey::class);
    }
}
