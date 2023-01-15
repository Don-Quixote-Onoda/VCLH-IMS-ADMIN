<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRate extends Model
{
    use HasFactory;

    protected $table = 'room_rates';
    public $primaryKey = 'id';
    public $timestamp = true;

    public function transactions() {
        return $this->hasMany('App\Models\Transaction');
    }

    public function room() {
        return $this->belongsTo('App\Models\Room');
    }
}
