<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inn extends Model
{
    use HasFactory;

    protected $table = 'inns';
    public $primaryKey = 'id';
    public $timestamp = true;


    public function rooms() {
        return $this->hasMany('App\Models\Room');
    }

    public function freebie() {
        return $this->belongsTo('App\Models\Freebie');
    }

    public function transactions() {
        return $this->hasMany('App\Models\Transaction');
    }
}
