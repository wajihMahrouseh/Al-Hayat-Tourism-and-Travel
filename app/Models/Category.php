<?php

namespace App\Models;

use App\Models\Site;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = ['name'];


    public function sites()
    {
        $this->hasMany(Site::class);
    }
}
