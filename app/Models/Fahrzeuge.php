<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fahrzeuge extends Model
{
    use HasFactory;

    protected $fillable = [
        'funkrufname',
        'kennzeichen',
        'fahrzeugart',
        'img',
    ];

}
