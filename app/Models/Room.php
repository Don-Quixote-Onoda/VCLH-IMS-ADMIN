<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function inn()
    {
        return $this->belongsTo('App\Models\Inn');
    }

    public function freebie()
    {
        return $this->belongsTo('App\Models\Freebie');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function roomRate()
    {
        return $this->belongsTo('App\Models\RoomRate');
    }
    public function room_rates()
{
    return $this->hasMany(RoomRate::class);
}
}

