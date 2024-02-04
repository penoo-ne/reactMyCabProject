<?php

namespace App\Http\Controllers\Modules\SuperAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modules\SuperAdmin\Models\Assign_fleets;
use Illuminate\Http\Request;

class AssignFleetsController extends Controller
{
    public function addAssignFleet(Request $request){
        $request->validate([
            'driver_id'=> 'required|string',
            'fleet_id'=> 'required|string',
            'is_deleted' => 'nullable|in:delete,not_delete',
        ]);
        $Assignfleet = new Assign_fleets;
        $Assignfleet->driver_id = $request->driver_id;
        $Assignfleet->fleet_id = $request->fleet_id;
        $Assignfleet->is_deleted = $request->is_deleted=='delete' ? 1 : 0;
        $Assignfleet->save();

        if($Assignfleet){
            return response()->json([
                'success'=> true,
                'message'=>'Assign fleets added successfully.',
                'data'=> $Assignfleet
            ]);   
        }
        else{
            return response()->json([
                'success'=> false,
                'message'=>'Something went wrong.',
                'data'=> $Assignfleet
            ]);      
        }
    }
    public function assignFleetlist(){
        $Assignfleets = Assign_fleets::join('fleets', 'assign_fleets.fleet_id', '=', 'fleets.fleet_id')
        ->join('drivers', 'assign_fleets.driver_id', '=', 'drivers.driver_id')
        ->select(
            'assign_fleets.assign_fleet_id',
             'drivers.name  as driver_name', 
             'fleets.name as fleets_name'
        )
        ->orderBy('assign_fleets.assign_fleet_id', 'desc')
        ->where('assign_fleets.is_deleted', 0)
        ->paginate(10);
        

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

    public function deleteAssignFleet(Request $request, $assign_fleet_id)
    {
    $AssignFleet = Assign_fleets::where('assign_fleet_id', $assign_fleet_id)->update(['is_deleted'=>'1']);

    if($AssignFleet){
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
            'id'=> $assign_fleet_id
        ],200);
    }
    else{
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong.',
        ],401);
    }
}


public function editAssignFleet(Request $request, $assign_fleet_id)
    {
        $AssignFleets = $request->validate([
            'driver_id'=> 'required|string',
            'fleet_id'=> 'required|string',
            'is_deleted' => 'nullable|in:delete,not_delete',
        ]);
        $updatedAssignFleets = Assign_fleets::where('assign_fleet_id', '=', $assign_fleet_id)->update([
            'driver_id' => $AssignFleets['driver_id'],    
            'fleet_id' => $AssignFleets['fleet_id'],
            'is_deleted' => $AssignFleets['is_deleted']=='delete' ? 1 : 0,
        ]); 
        if($updatedAssignFleets){
            return response()->json([
                'success' => true,
                'message' => 'AssignFleets updated successfully.',
                'data' => $AssignFleets
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => []
            ],401);
    
        }

       

    }
    }

