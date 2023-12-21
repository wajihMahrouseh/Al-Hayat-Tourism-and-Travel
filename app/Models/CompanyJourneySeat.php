<?php

namespace App\Models;

use App\Models\ReservationOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyJourneySeat extends Model
{
    use HasFactory;


    public function reservationOrder()
    {
        return $this->belongsTo(ReservationOrder::class);
    }
}
