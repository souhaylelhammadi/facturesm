<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'number',
        'client',
        'due_date',
        'amount',
        'status',
        'description',
    ];
}
