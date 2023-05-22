<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POS_Transaction extends Model
{
    use HasFactory;

    protected $table = 'p_o_s__transactions';
    public $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'order_number',
        'transaction_id', 
        'total_amount',
        'inn_id',
    ];
}
