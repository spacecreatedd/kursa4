<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'route',
        'ticket_id',
        'description',
        'tour_operator_id',
        'hotel_id',
        'img'
    ];
}
