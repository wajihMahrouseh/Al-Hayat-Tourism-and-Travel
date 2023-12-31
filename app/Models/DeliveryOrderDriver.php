<?php

namespace App\Models;

use App\Models\Driver;
use App\Models\DeliveryOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryOrderDriver extends Model
{
    use HasFactory;


    protected $fillable = [
        'driver_id',
        'delivery_order_id',
        'status'
    ];


    public function deliveryOrder()
    {
        return $this->belongsTo(DeliveryOrder::class);
    }


    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
