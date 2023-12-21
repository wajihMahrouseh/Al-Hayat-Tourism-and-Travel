<?php

namespace App\Models;

use App\Models\Journey;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function journeys()
    {
        return $this->hasMany(Journey::class);
    }
}
