<?php

namespace App\Models;

use App\Models\Journey;
use App\Models\DeliveryOrder;
use App\Models\CompanyJourneySeat;
use App\Models\IndividualJourneySeat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationOrder extends Model
{
    use HasFactory;


    public function journey()
    {
        $this->belongsTo(Journey::class);
    }


    public function individualJourneySeats()
    {
        $this->hasMany(IndividualJourneySeat::class);
    }


    public function companyJourneySeats()
    {
        $this->hasMany(CompanyJourneySeat::class);
    }


    public function deliveryOrder()
    {
        $this->hasOne(DeliveryOrder::class);
    }
}
