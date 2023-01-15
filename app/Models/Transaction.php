<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    public $primaryKey = 'id';
    public $timestamp = true;

    public function inn() {
        return $this->belongsTo('App\Models\Inn');
    }

    public function room() {
        return $this->belongsTo('App\Models\Room');
    }

    public function room_rate() {
        return $this->belongsTo('App\Models\RoomRate');
    }

    public function user() {
        return $this->belongsTo('App\Models\Username');
    }
}
