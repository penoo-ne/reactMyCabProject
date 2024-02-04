<?php

namespace App\Http\Controllers\Modules\SuperAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modules\SuperAdmin\Models\Fleets;
use App\Models\Modules\SuperAdmin\Models\Team_admin_assign_fleets;

class FleetsController extends Controller
{
    public function addNewFleet(Request $request)
    {
         $request->validate([
            'name'=>'required|string',
            'serial_no' => 'required|string',
            'status' => 'required|in:active,inactive',
            'is_deleted' => 'nullable|in:delete,not_delete',
        ]);
        $fleetData = new Fleets;
            $fleetData->name = $request->name;
            $fleetData->serial_no = $request->serial_no;
            $fleetData->status = $request->status=='active' ? 1 : 0;
            $fleetData->is_deleted = $request->is_deleted=='delete' ? 1 : 0;
            $fleetData->save();

            if($fleetData){
           
        // $TAassignFleets = Team_admin_assign_fleets::create([
        //     'fleet_id' => $fleetData->fleet_id,
        // ]);
    
        //  echo '<pre>';print_r($userRole);die();
        
            return response()->json([
                'success' => true,
                'message' => 'Fleet created successfully.',
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

    public function FleetList()
    {
        $Fleets = Fleets::where('is_deleted', 0)->orderBy('fleet_id', 'desc')->paginate(10);
        if($Fleets->isNotEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'Drivers list.',
                'data' => $Fleets,
                'pagination' => [
                    'total' => $Fleets->total(),
                    'per_page' => $Fleets->perPage(),
                    'current_page' => $Fleets->currentPage(),
                    'last_page' => $Fleets->lastPage(),
                    'from' => $Fleets->firstItem(),
                    'to' => $Fleets->lastItem(),
                ],
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'No data available.',
                'data' => []
            ],401);

        }
    }

    public function deleteFleet(Request $request, $fleet_id)
    {
        $fleet = Fleets::where('fleet_id', $fleet_id)->update(['is_deleted'=>'1']);

        if($fleet){
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

    public function editFleet(Request $request, $fleet_id)
    {
        $fleet = $request->validate([
            'name'=>'required|string',
            'serial_no' => 'required|string',
            'status' => 'required|in:active,inactive',
            'is_deleted' => 'nullable|in:delete,not_delete',
        ]);
        $updateFleet = Fleets::where('fleet_id', '=', $fleet_id)->update([
            'name' => $fleet['name'],
            'serial_no' => $fleet['serial_no'],
            'status' => $fleet['status']=='active' ? 1 : 0,
            'is_deleted' => $fleet['is_deleted']=='delete' ? 1 : 0,
        ]); 
        if($updateFleet){
            return response()->json([
                'success' => true,
                'message' => 'Fleet updated successfully.',
                'data' => $fleet
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
