<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    public $primaryKey = 'id';
    public $timestamp = true;

    public function inn() {
        return $this->belongsTo('App\Models\Inn');
    }

    public function freebie() {
        return $this->belongsTo('App\Models\Freebie');
    }

    public function transactions() {
        return $this->hasMany('App\Models\Transaction');
    }

    public function room_rates() {
        return $this->hasMany('App\Models\RoomRate');
    }

}
