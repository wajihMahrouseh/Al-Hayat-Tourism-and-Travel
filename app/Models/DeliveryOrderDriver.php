<?php

namespace App\Models;

use App\Models\Driver;
use App\Models\DeliveryOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryOrderDriver extends Model
{
    use HasFactory;


    public function deliveryOrder()
    {
        $this->belongsTo(DeliveryOrder::class);
    }


    public function driver()
    {
        $this->belongsTo(Driver::class);
    }
}
