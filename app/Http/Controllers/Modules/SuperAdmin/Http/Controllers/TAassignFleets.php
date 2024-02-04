<?php

namespace App\Http\Controllers\Modules\SuperAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modules\SuperAdmin\Models\Team_admin_assign_fleets;
use App\Models\Modules\SuperAdmin\Models\Fleets;
use App\Models\Modules\SuperAdmin\Models\Team_admin;
use Illuminate\Http\Request;

class TAassignFleets extends Controller
{

     public function assignNewfleet(Request $request)
    {
         $request->validate([
            'fleet_id'=>'required|string',
            'team_admin_id' => 'required|string',
            'is_deleted' => 'nullable|in:delete,not_delete',
        ]);
        $fleetData = new Team_admin_assign_fleets;
            $fleetData->fleet_id = $request->fleet_id;
            $fleetData->team_admin_id = $request->team_admin_id;
            $fleetData->is_deleted = $request->is_deleted=='delete' ? 1 : 0;
            $fleetData->save();

            if($fleetData){
        
            return response()->json([
                'success' => true,
                'message' => 'Fleet assigned successfully.',
                'data' => $fleetData
            ],200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'data' => []
            ],401);
        }
        
    }


    public function assignfleetList(){  
        // $users = User::where('user_id','=',$Assignfleets->user_id)->first();
        // $fleets = Fleets::where('fleet_id','=', $Assignfleets->fleet_id)->first();
        $Assignfleets = Team_admin_assign_fleets::join('fleets', 'team_admin_assign_fleets.fleet_id', '=', 'fleets.fleet_id')
        ->join('team_admins', 'team_admin_assign_fleets.team_admin_id', '=', 'team_admins.team_admin_id')
        ->select(
            'team_admin_assign_fleets.*',
             'team_admins.user_id  as team_admin', 
             'fleets.name as fleets_name'
        )
        ->orderBy('team_admin_assign_fleets.TA_assign_fleet_id', 'desc')
        ->where('team_admin_assign_fleets.is_deleted', 0)
        ->paginate(10);
        
        // dd($Assignfleets);
        //  echo '<pre>';print_r($Assignfleets);die();
        if($Assignfleets){
            return response()->json([
                'success' => true,
                'message' => 'Assign fleets listed successfully.',
                'data' => $Assignfleets,
                'pagination' => [
                    'total' => $Assignfleets->total(),
                    'per_page' => $Assignfleets->perPage(),
                    'current_page' => $Assignfleets->currentPage(),
                    'last_page' => $Assignfleets->lastPage(),
                    'from' => $Assignfleets->firstItem(),
                    'to' => $Assignfleets->lastItem(),
                ],
                
            ],200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'data' => []
            ],401);
        }
        
    }

    public function deleteAssignFleet(Request $request, $TA_assign_fleet_id)
    {
        $assignfleets = Team_admin_assign_fleets::where('TA_assign_fleet_id', $TA_assign_fleet_id)->update(['is_deleted'=>'1']);

        if($assignfleets){
            return response()->json([
                'success' => true,
                'message' => 'Fleet deleted successfully.',
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ],401);
        }
    }

}
