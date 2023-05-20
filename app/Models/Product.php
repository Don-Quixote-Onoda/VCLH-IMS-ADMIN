<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'name',
        'image', 
        'description',
        'quantity',
        'price',
        'category_id',
        'inn_id',
        'is_deleted',
    ];
}
