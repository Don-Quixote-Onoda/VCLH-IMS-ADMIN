<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryManagement extends Model
{
    use HasFactory;

    protected $table = 'inventory_management';
    public $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'name',
        'image',
        'quantity', 
        'inn_id',
        'is_deleted'
    ];
}
