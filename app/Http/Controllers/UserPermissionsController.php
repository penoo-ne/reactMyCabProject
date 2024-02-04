<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;/////schema is a facade that interact with database
use App\Models\{Permission,User,User_permissions};

class UserPermissionsController extends Controller
{
    public function userPermissionsList(Request $request)
    {
        // $UserPermission =User_permissions::join('users', 'user_permissions.user_id', '=', 'users.user_id')
        //     ->join('permissions', 'user_permissions.permission_id', '=', 'users.permission_id')
        $UserPermission = User_permissions::join('users', 'user_permissions.user_id', '=', 'users.user_id')
    ->join('permissions', function ($join) {
        $join->on('user_permissions.permission_id', '=', 'permissions.permission_id')
             ->when(
                 Schema::hasColumn('permissions', 'parent'),
                 function ($query) {
                     // Add the join condition only if the 'parent' column exists
                     $query->on('permissions.parent', '=', 'parent'); // Replace 'some_value' with your actual condition
                 },
                 function ($query) {
                     // If 'parent' column doesn't exist, you can return an error message or handle it as needed
                     throw new \Exception('Permission does not have a parent.');
                 }
             );
    })
            ->select(
                'user_permissions.user_permission_id',
                'users.name as user_name',
                'users.email',
                'permissions.name as permission_name',
                'permissions.parent as parent_permission'
            )
            ->orderBy('user_permissions.user_permission_id', 'desc')
            ->get();
        if($UserPermission)
        {
            return response()->json([
                'success' => true,
                'message' => 'User permissions listed successfully.',
                'data' => $UserPermission
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
}
