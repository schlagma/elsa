<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeList extends Model
{
    protected $table = 'lists';

    protected $fillable = [
        'name',
        'description',
        'election',
        'committee',
        'seats',
        'seats_deputy',
    ];
}
