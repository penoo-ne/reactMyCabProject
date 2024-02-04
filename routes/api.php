<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserPermissionsController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SecondaryPermissionController;
use App\Http\Controllers\LevelController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

//login logout
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])->middleware('auth:sanctum');
//user routes
Route::post('/add-new-user', [UserAuthController::class, 'addNewUser']);
Route::get('/users-list', [UserAuthController::class, 'usersList'])->middleware('auth:sanctum');
Route::get('/users/{user_id}/edit', [UserAuthController::class, 'usersListId']);

Route::delete('/delete-user/{user_id}', [UserAuthController::class, 'deleteUser'])->middleware('auth:sanctum');
Route::post('/edit-new-user/{user_id}', [UserAuthController::class, 'editNewUser'])->middleware('auth:sanctum');

///////get roles and permissions data
Route::get('/get-users-data', [UserAuthController::class, 'getUserData']);
///////forget password
Route::post('/send-link', [UserAuthController::class, 'sendLink']);
Route::post('/change-password', [UserAuthController::class, 'changePassword']);



/////////roles
Route::post('/add-new-role', [RoleController::class, 'addNewRole']);
Route::get('/users-role-list', [RoleController::class, 'usersRoleList']);
Route::delete('/delete-role/{id}', [RoleController::class, 'deleteRole']);
Route::post('/edit-new-role/{id}', [RoleController::class, 'editNewRole']);
/////////////permissions
Route::post('/add-new-permission', [PermissionController::class, 'addNewUserPermission']);
Route::get('/user-permission-list', [PermissionController::class, 'userPermissionList']);
Route::delete('/delete-permission/{id}', [PermissionController::class, 'deletePermission']);
Route::post('/edit-permission/{id}', [PermissionController::class, 'editPermission']);
/////////user_roles
Route::get('/user-role-list', [UserRoleController::class, 'userRoleList']);
////////user_permission
Route::get('/user-permissions-list', [UserPermissionsController::class, 'userPermissionsList']);

////////role_permission
Route::get('/role-permissions-list', [RolePermissionController::class, 'rolePermissionsList']);
////////secondary permissions
Route::post('/add-new-secondary-permission', [SecondaryPermissionController::class, 'addNewSecondaryPermission']);
Route::get('/user-secondary-permission-list', [SecondaryPermissionController::class, 'secondaryPermissionsList']);
Route::delete('/delete-secondary-permission/{id}', [SecondaryPermissionController::class, 'deleteSecondaryPermission']);
Route::post('/edit-secondary-permission/{id}', [SecondaryPermissionController::class, 'editSecondaryPermission']);
////////levels
Route::post('/add-new-level', [LevelController::class, 'addNewLevel']);
Route::get('/levels-list', [LevelController::class, 'LevelsList']);
Route::delete('/delete-levels/{id}', [LevelController::class, 'deleteLevels']);
Route::post('/edit-level/{id}', [LevelController::class, 'editLevel']);