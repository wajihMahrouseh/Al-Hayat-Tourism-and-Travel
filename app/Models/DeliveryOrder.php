<?php

namespace App\Models;

use App\Models\Driver;
use App\Models\ReservationOrder;
use App\Models\DeliveryOrderDriver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryOrder extends Model
{
    use HasFactory;


    public function reservationOrder()
    {
        return $this->belongsTo(ReservationOrder::class);
    }


    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }


    public function deliveryOrderDriver()
    {
        return $this->hasMany(DeliveryOrderDriver::class);
    }
}
