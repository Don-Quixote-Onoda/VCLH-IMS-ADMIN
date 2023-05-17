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
    ];

    
   

    public function updateStatus($newStatus)
    {
        if (in_array($newStatus, $this->statusOptions)) {
            $this->status = $newStatus;
            $this->save();
            return true;
        }
        return false;
    }
}
