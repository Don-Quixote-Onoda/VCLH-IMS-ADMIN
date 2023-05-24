<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Payment extends Model
{
    // Define the table associated with the model
    protected $table = 'payments';

    // Define the fillable attributes
    protected $fillable = [
        'amount',
        'payment_input',
        'change',
        // Add any other attributes you have in the `payments` table
    ];

    // Define any relationships or additional methods
}
