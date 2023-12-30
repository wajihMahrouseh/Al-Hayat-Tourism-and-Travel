<?php

namespace App\Models;

use App\Models\Journey;
use App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = ['name'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function journeys()
    {
        return $this->hasMany(Journey::class);
    }
}
