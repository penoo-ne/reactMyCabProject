<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Permission,Secondary_permission};

class PermissionController extends Controller
{
    public function addNewUserPermission(Request $request)
    {
        $permission = $request->validate([
            'name'=>'required|string',
            'routes' => 'required|string',
            'is_deleted' => 'nullable|in:delete,not_delete',
            'sp_id' => 'required|string',
            'parent' => 'required|string',
            'level_id' => 'required|string',
        ]);
        $userPermission = Permission::create([
            'name' => $permission['name'],
            'routes' => $permission['routes'],
            'is_deleted' => $permission['is_deleted']=='delete' ? 1 : 0,
            'sp_id' => $permission['sp_id'],
            'parent' => $permission['parent'],
            'level_id' => $permission['level_id'],
        ]);
        if($userPermission)
        {
            return response()->json([
                'success' => true,
                'message' => 'Permission created successfully.',
                'data' => $permission
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

    public function userPermissionList()
    {
        $permissions = Permission::join('secondary_permissions', 'secondary_permissions.sp_id', '=', 'permissions.sp_id')
        ->join('levels', 'levels.level_id', '=', 'permissions.level_id')
        ->select(
            'permissions.name',
            'permissions.routes',
            'permissions.is_deleted',
            'secondary_permissions.name as secondary_permissions_name',
            'levels.name as level_name'
        )
    ->orderBy('permissions.permission_id', 'desc')
    ->where('permissions.is_deleted', 0)
    ->paginate(10);

        //  $permissions = Permission::where('is_deleted', 0)->orderBy('permission_id', 'desc')->paginate();
        if($permissions->isNotEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'Permissions list.',
                'data' => $permissions,
                'pagination' => [
                    'total' => $permissions->total(),
                    'per_page' => $permissions->perPage(),
                    'current_page' => $permissions->currentPage(),
                    'last_page' => $permissions->lastPage(),
                    'from' => $permissions->firstItem(),
                    'to' => $permissions->lastItem(),
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
    public function deletePermission(Request $request, $permission_id)
    {
        $permission = Permission::where('permission_id', $permission_id)->update(['is_deleted'=> '1']);

        if($permission){
            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully.',
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ],401);
        }
    }
    public function editPermission(Request $request, $permission_id)
    {
        $permission = $request->validate([
            'name'=>'required|string',
            'routes' => 'required|string',
            'is_deleted' => 'nullable|in:delete,not_delete',
            'sp_id' => 'required|string',
            'parent' => 'required|string',
            'level_id' => 'required|string',
        ]);
        $updatedPermission = Permission::where('permission_id', '=', $permission_id)->update([
            'name' => $permission['name'],    
            'routes' => $permission['routes'],
            'is_deleted' => $permission['is_deleted']=='delete' ? 1 : 0,
            'sp_id' => $permission['sp_id'],
            'parent' => $permission['parent'],
            'level_id' => $permission['level_id'],
        ]); 
        if($updatedPermission){
            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully.',
                'data' => $permission
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
