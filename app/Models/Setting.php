<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'who_us',
        'phone',
        'email',
        'facebook',
        'website',
        'address',
        'work_time',
    ];
}
