<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'location',
        'place_of_event',
        'image',
        'description',
        'date_of_event',
        'user_visibility',
        'creator_user_id',
    ];

}
