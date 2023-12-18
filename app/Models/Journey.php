<?php

namespace App\Models;

use App\Models\Site;
use App\Models\ReservationOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journey extends Model
{
    use HasFactory;


    public function site()
    {
        $this->belongsTo(Site::class);
    }


    public function reservationOrder()
    {
        $this->hasMany(ReservationOrder::class);
    }
}
