<?php

namespace App\Models;

use App\Models\User;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderDriver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'phone',
        'car_number',
        'car_color',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function deliveryOrder()
    {
        return $this->belongsToMany(DeliveryOrder::class);
    }


    public function deliveryOrderDriver()
    {
        return $this->hasMany(DeliveryOrderDriver::class);
    }
}
