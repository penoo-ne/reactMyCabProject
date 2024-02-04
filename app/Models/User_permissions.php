<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_permissions extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'permission_id',
        'parent_permission',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_id');
    }
}
