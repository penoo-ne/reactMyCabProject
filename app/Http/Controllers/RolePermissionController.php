<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Permission,Role,Role_permission};

class RolePermissionController extends Controller
{
    public function rolePermissionsList(Request $request){
        $RolePermission = Role_permission::join('roles', 'role_permissions.role_id', '=', 'roles.role_id')
        ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.permission_id')
        ->select(
            'role_permissions.role_permission_id',
             'roles.name  as role_name', 
             'permissions.name as permission_name',
        )
        ->orderBy('role_permissions.role_permission_id', 'desc')
        ->get();

        // echo '<pre>';print_r($RolePermission);die();
        if($RolePermission){
            return response()->json([
                'success' => true,
                'message' => 'Role permissions listed successfully.',
                'data' => $RolePermission
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
    

