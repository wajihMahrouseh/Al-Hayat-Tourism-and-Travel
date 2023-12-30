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


    protected $fillable = ['total_journey_seat_num', 'status'];


    public function journey()
    {
        return $this->belongsTo(Journey::class);
    }


    public function individualJourneySeats()
    {
        return $this->hasMany(IndividualJourneySeat::class);
    }


    public function companyJourneySeats()
    {
        return $this->hasMany(CompanyJourneySeat::class);
    }


    public function deliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::class);
    }
}
