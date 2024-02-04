<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function addNewRole(Request $request)
    {
        $role = $request->validate([
            'name'=>'required|string',
            'status' => 'required|in:active,inactive',
            'is_deleted' => 'nullable|in:delete,not_delete',
        ]);
        $userRole = Role::create([
            'name' => $role['name'],
            'status' => $role['status']=='active' ? 1 : 0,
            'is_deleted' => $role['is_deleted']=='delete' ? 1 : 0,
        ]);
        //  echo '<pre>';print_r($userRole);die();
        if($userRole)
        {
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully.',
                'data' => $userRole
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
    public function usersRoleList()
    {
        $roles = Role::where('is_deleted', 0)->orderBy('role_id', 'desc')->paginate(10);
        if($roles->isNotEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'Users role list.',
                'data' => $roles,
                'pagination' => [
                    'total' => $roles->total(),
                    'per_page' => $roles->perPage(),
                    'current_page' => $roles->currentPage(),
                    'last_page' => $roles->lastPage(),
                    'from' => $roles->firstItem(),
                    'to' => $roles->lastItem(),
                ]
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
    public function deleteRole(Request $request, $role_id)
    {
        $role = Role::where('role_id', $role_id)->update(['is_deleted'=> '1']);

        if($role){
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.',
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ],401);
        }
    }
    public function editNewRole(Request $request, $role_id)
    {
        $role = $request->validate([
            'name'=>'required|string',
            'status' => 'required|in:active,inactive',
            'is_deleted' => 'nullable|in:delete,not_delete',
        ]);
        Role::where('role_id', '=', $role_id)->update([
            'name' => $role['name'],    
            'status' => $role['status'],
            'is_deleted' => $role['is_deleted']=='delete' ? 1 : 0,
        ]); 
        // echo '<pre>';print_r($role);die();
        if($role){
            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully.',
                'data' => $role
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


    
