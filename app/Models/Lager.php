<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ablaufdatum',
        'anzahl',
        'lagerort',
        'img',
        'photo',
    ];


}
