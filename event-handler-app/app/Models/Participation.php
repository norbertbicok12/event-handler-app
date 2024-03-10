<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'participate';

    protected $fillable = [
        'event_id',
        'user_id'
    ];
}
