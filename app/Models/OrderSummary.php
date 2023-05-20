<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSummary extends Model
{
    use HasFactory;

    protected $table = 'order_summaries';
    public $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'total_amount',
        'payment', 
        'change',
        'order_number',
        'room_id',
        'inn_id',
        'is_deleted',
    ];
}
