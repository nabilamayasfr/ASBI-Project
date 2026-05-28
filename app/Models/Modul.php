<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $fillable = [
        'modul',
        'huruf',
        'thumbnail',
        'penjelasan',
    ];
}
