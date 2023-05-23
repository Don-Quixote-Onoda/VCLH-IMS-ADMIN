<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    public $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'order_number', 
        'quantity', 
        'price', 
        'subtotal', 
        'product_id', 
        'is_deleted', 
        'inn_id',
        
    ];

    public function transactions() {
        return $this->hasMany('App\Models\Transaction');
    }

}
