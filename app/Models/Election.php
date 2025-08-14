<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'infotext',
        'public',
        'candidates_exist',
        'all_votes_counted',
    ];
}
