<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Ticket_Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id'
    ];
}
