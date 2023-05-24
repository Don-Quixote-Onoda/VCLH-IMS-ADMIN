<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    

    protected $table = 'transactions';
    public $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        // other columns...
        'selected_products',
    ];

    public function inn() {
        return $this->belongsTo('App\Models\Inn');
    }

    public function room() {
        return $this->belongsTo('App\Models\Room');
    }

    public function room_rate() {
        return $this->belongsTo(RoomRate::class, 'room_rate_id');
    }
    public function roomRate()
    {
        return $this->belongsTo(RoomRate::class, 'room_rate_id');
       
    }
    
    public function user() {
        return $this->belongsTo('App\Models\Username');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_transaction')
            ->withPivot('quantity');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }


    
}
