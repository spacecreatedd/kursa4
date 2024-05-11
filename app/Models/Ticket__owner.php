<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Ticket__owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id'
    ];
}
