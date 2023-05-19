<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public static function getStatusOptions()
    {
        return [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'canceled' => 'Canceled',
        ];
    }

    public $fillable = [
        'day_of_reservation',
        'name',
        'contact_number',
        'status',
        'inn_id',
        'room_id',
        'room_rate_id',
    ];

    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function roomRate()
    {
        return $this->belongsTo('App\Models\RoomRate');
    }
}