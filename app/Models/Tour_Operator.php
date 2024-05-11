<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour_Operator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'patronym',
        'contacts'
    ];
}
