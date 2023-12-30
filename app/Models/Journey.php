<?php

namespace App\Models;

use App\Models\Site;
use App\Models\ReservationOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journey extends Model
{
    use HasFactory;


    protected $fillable = [
        'start_date',
        'duration',
        'price',
        'description',
        'rows',
        'right_columns',
        'left_columns',
        'back_columns',
    ];


    public function site()
    {
        return $this->belongsTo(Site::class);
    }


    public function reservationOrder()
    {
        return $this->hasMany(ReservationOrder::class);
    }


    public function individualJourneySeats()
    {
        return $this->hasManyThrough(
            IndividualJourneySeat::class,
            ReservationOrder::class,
            'journey_id', // Foreign key on ReservationOrder table
            'reservation_order_id' // Foreign key on IndividualJourneySeat table
        );
    }
}
