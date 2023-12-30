<?php

namespace App\Models;

use App\Models\ReservationOrder;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndividualJourneySeat extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'place_and_birth_date',
        'national_number',
        'phone',
        'email',
        'seat_number',
    ];

    public function reservationOrder()
    {
        return $this->belongsTo(ReservationOrder::class);
    }
}
