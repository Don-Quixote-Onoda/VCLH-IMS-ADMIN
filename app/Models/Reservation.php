<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    public $primaryKey = 'id';
    public $timestamp = true;

    public $fillable = [
        'day_of_reservation', 
        'name',
        'contact_number',
        'inn_id',
        'room_id',
    ];
}
