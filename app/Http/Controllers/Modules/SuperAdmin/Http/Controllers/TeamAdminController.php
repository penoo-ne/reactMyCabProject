<?php

namespace App\Http\Controllers\Modules\SuperAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modules\SuperAdmin\Models\Team_admin;
use App\Models\User;
use Illuminate\Http\Request;

class TeamAdminController extends Controller
{
    public function getTeamAdminUsers()
    {
        
        $teamAdmin = Team_admin::with(['user:user_id,name'])->orderBy('team_admin_id', 'desc')->paginate(10);

       if($teamAdmin){
        return response()->json([
            'success' => true,
            'message' => 'Team admin users fetched successfully.',
            'data' => $teamAdmin
        ], 200);
    }

    else{
           return response()->json([
            'success' => false,
            'message' => 'Something went wrong.',
            'data' => []
        ], 200);
    }

}
}