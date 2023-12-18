<?php

namespace App\Models;

use App\Models\ReservationOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndividualJourneySeat extends Model
{
    use HasFactory;


    public function reservationOrder()
    {
        $this->belongsTo(ReservationOrder::class);
    }
}
