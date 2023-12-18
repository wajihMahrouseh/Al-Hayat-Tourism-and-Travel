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


    public function user()
    {
        $this->belongsTo(User::class);
    }


    public function deliveryOrder()
    {
        $this->belongsToMany(DeliveryOrder::class);
    }


    public function deliveryOrderDriver()
    {
        $this->hasMany(DeliveryOrderDriver::class);
    }
}
