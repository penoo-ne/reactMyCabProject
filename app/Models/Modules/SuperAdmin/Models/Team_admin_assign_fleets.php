<?php

namespace App\Models\Modules\SuperAdmin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_admin_assign_fleets extends Model
{
    use HasFactory;
    protected $fillable = [
        'fleet_id',
        'team_admin_id',
        'is_deleted',
    ];
}
