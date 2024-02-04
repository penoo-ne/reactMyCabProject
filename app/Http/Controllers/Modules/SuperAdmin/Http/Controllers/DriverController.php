<?php

namespace App\Http\Controllers\Modules\SuperAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modules\SuperAdmin\Models\Driver;

class DriverController extends Controller
{
    public function addNewDriver(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'father_name' => 'required|string',
            'gender' => 'required|string',
            'country' => 'required|string',
            'identity_number' => 'required|min:6',
            'date_of_birth' => 'required|string',
            'permanent_address' => 'required|string',
            'present_address' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_deleted' => 'nullable|in:delete,not_delete',
        ]);
            $driverData = new Driver;
            $driverData->name = $request->name;
            $driverData->father_name = $request->father_name;
            $driverData->gender = $request->gender;
            $driverData->country = $request->country;
            $driverData->identity_number = $request->identity_number;
            $driverData->date_of_birth = $request->date_of_birth;
            $driverData->permanent_address = $request->permanent_address;
            $driverData->present_address = $request->present_address;
            $driverData->is_deleted = $request->is_deleted == 'delete' ? 1 : 0;

            
            
            if ($request->hasFile('image'))
            {
              $image= $request->file('image');
              $filename = time().'-'.$image->getClientOriginalName();
              $image->storeAs('storage/app', $filename);
              $driverData->image = $filename;
              // dd($user->image);
            }
            $driverData->save();
        //  echo '<pre>';print_r($userRole);die();
        if($driverData)
        {
            return response()->json([
                'success' => true,
                'message' => 'Driver created successfully.',
                'data' => $driverData
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

    public function DriversList()
    {
        $Drivers = Driver::where('is_deleted', 0)->orderBy('driver_id', 'desc')->paginate(10);
        if($Drivers->isNotEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'Drivers list.',
                'data' => $Drivers,
                'pagination' => [
                    'total' => $Drivers->total(),
                    'per_page' => $Drivers->perPage(),
                    'current_page' => $Drivers->currentPage(),
                    'last_page' => $Drivers->lastPage(),
                    'from' => $Drivers->firstItem(),
                    'to' => $Drivers->lastItem(),
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

    public function deleteDriver(Request $request, $driver_id)
    {
        $driver = Driver::where('driver_id', $driver_id)->update(['is_deleted'=> '1']);

        if($driver){
            return response()->json([
                'success' => true,
                'message' => 'Driver deleted successfully.',
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ],401);
        }
    }


    public function editDriver(Request $request, $driver_id)
    {
        $driver = $request->validate([
            'name'=>'required|string',
            'father_name' => 'required|string',
            'gender' => 'required|string',
            'country' => 'required|string',
            'identity_number' => 'required|min:13',
            'date_of_birth' => 'required|string',
            'permanent_address' => 'required|string',
            'present_address' => 'required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_deleted' => 'nullable|in:delete,not_delete',
            
        ]);
        $updateDriver = Driver::where('driver_id', '=', $driver_id)->update([
            'name' => $driver['name'],
            'father_name' => $driver['father_name'],
            'gender' => $driver['gender'],
            'country' => $driver['country'],
            'identity_number' => $driver['identity_number'],
            'date_of_birth' => $driver['date_of_birth'],
            'permanent_address' => $driver['permanent_address'],
            'present_address' => $driver['present_address'],
            'is_deleted' => $driver['is_deleted']=='delete' ? 1 : 0,
        ]); 
        $updatedDriver = Driver::where('driver_id', '=', $driver_id)->first();
        if ($request->hasFile('image'))
            {
              $image= $request->file('image');
              $filename = time().'-'.$image->getClientOriginalName();
              $image->storeAs('storage/app', $filename);
              $updatedDriver->image = $filename; 
            }
            $updatedDriver->save();
        if($updateDriver){
            return response()->json([
                'success' => true,
                'message' => 'Driver updated successfully.',
                'data' => $updatedDriver
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
