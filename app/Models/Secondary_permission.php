<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secondary_permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'slug',
        'is_deleted',
    ];
}
