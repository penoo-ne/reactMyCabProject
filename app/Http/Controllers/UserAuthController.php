<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\EmailNotification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\{User,User_roles,User_permissions,Role,Permission,Role_permission};
use App\Models\Modules\SuperAdmin\Models\Team_admin_assign_fleets;
use App\Models\Modules\SuperAdmin\Models\Team_admin;
use App\Models\Modules\SuperAdmin\Models\Fleets;
use Hash;
use Auth;


class UserAuthController extends Controller
{
    public function addNewUser(Request $request){ 

        $request->validate([
            'name'=>'required|string|unique:users',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:6',
            'status' => 'required|in:active,inactive',
            'role_id'=>'required|string',
            // 'permission_id'=>'required|string',
            'is_deleted' => 'nullable|in:delete,not_delete',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'franchise_id'=>'required|string',
            'is_franchise_owner' => 'nullable|in:franchise_owner,customer',
        ]);
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->status = $request->status=='active' ? 1 : 0;
            $user->role_id = $request->role_id;
            // $user->permission_id = $request->permission_id;
             $user->is_deleted = $request->is_deleted=='delete' ? 1 : 0;
            $user->franchise_id = $request->franchise_id;
            $user->is_franchise_owner = $request->is_franchise_owner=='franchise_owner' ? 1 : 0;
            



            if ($request->hasFile('image'))
            {
              $image= $request->file('image');
              $filename = time().'-'.$image->getClientOriginalName();
              $image->storeAs('public/images/', $filename);
             $user->image = $filename;
            }
            $user->save();

            // dd($user);
    //    if($user){
        //////insert into User_roles
//         $userRole = User_roles::create([
//             'user_id' => $user->user_id,
//             'role_id' => $user->role_id
//         ]);
// /////insert into User_permissions
//         $userPermission = User_permissions::create([
//             'user_id' => $user->user_id,
//             'permission_id' => $user->permission_id
//         ]);
// /////insert into Role_permission
//         $RolePermission = Role_permission::create([
//             'role_id' =>$user->role_id,
//             'permission_id' => $user->permission_id

//         ]);

        // $TAassignFleets = Team_admin_assign_fleets::create([
        //     'user_id' =>$user->user_id,

        // ]);

//////////insert users with TeamAdmin role into team_admin table
    //     $usersWithTeamAdminRole = User::join('roles', 'users.role_id', '=', 'roles.role_id')
    // ->where('roles.name', 'TeamAdmin')
    // ->get();
    //      foreach ($usersWithTeamAdminRole as $role) {
    //             Team_admin::create([
    //             'user_id' => $role->user_id,
    //    ]);
    // }
        // echo '<pre>';print_r($userPermission);die();
    //    }

       $user->setRememberToken(Str::random(60));
       $user->save();

       return response()->json([
        'success' => $user ? true : false,
        'message' => $user ? 'User created successfully.' : 'something went wrong',
        'data' => $user,
       ]);          
    
}
///////login
    public function login(Request $request){

        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:6'
        ]);
        $user = User::with('role')->where('email',$loginUserData['email'])->first();
        $roleName = Role::where('role_id', $user->role_id)->select('name')->first();
        
        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
                'data' => []
            ],401);
        }
        elseif($user->status == 'inactive'){
            return response()->json([
                'success' => false,
                'message' => 'Inactive user',
                'data' => []
            ],401);
        }

        
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        $user->forceFill([
            'remember_token' => $token,
        ])->save();
    

        return response()->json([
            'success' => true,
            'message' => 'Login successfully',
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
                'role' => $roleName,
            ],
            'access_token' => $token,
        ],200);
    }
/////logout
    public function logout(){
       
       
       // echo auth()->user()['id'];die();
       // auth()->user()->tokens()->delete();
       $logedInUserID = auth()->user()['user_id'];
       auth()->user()->tokens()->delete();
       User::where('user_id', $logedInUserID)->update(['remember_token'=>NULL]);



        return response()->json([
            "message"=>"logged out"
            
          ]);
    } 
  
        
    
    ///////list users
    public function usersList()
    {
        // echo auth()->user()['id'];die();

        // $users = User::where('is_deleted', 0)->orderBy('user_id', 'desc')->paginate(10);
        $users =User::select(
            'users.user_id',
            'users.name',
            'users.email',
            'users.password',
            'users.status',
            'users.image',
            'users.is_deleted',
            'roles.name as role_name',
            'franchises.name as  franchise_name'
        )
    ->where('users.is_deleted', 0)
    ->orderBy('user_id', 'desc')
    ->join('roles', 'users.role_id', '=', 'roles.role_id')
    ->join('franchises', 'users.franchise_id', '=', 'franchises.franchise_id')
    // ->join('franchises', 'franchises.franchise_id', '=', ' users.franchise_id')
    ->paginate(100);
    foreach ($users as $user) {
        $user->image = asset('storage/images/'.$user->image); // Get the full URL of the image
    }

        if($users->isNotEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'Users list.',
                'data' => $users,
                'pagination' => [
                    'total' => $users->total(),
                    'per_page' => $users->perPage(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
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
//////delete users
    public function deleteUser(Request $request, $user_id)
    {
    $user = User::where('user_id', $user_id)->update(['is_deleted'=>'1']);

    if($user){
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
        ],200);
    }
    else{
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong.',
        ],401);
    }
}
/////////////fetch user_id(
public function usersListId($user_id){

$users = User::find($user_id);
if($users){
    return response()->json([
        'success' => true,
        'message' => 'List user',
        'data'=> $users
    ],200);
}
else{
    return response()->json([
        'success' => false,
        'message' => 'Something went wrong.',
    ],401);
}
}
//////Update users
public function editNewUser(Request $request, $user_id)
{
    $UserData = $request->validate([
        'name' => 'required|string',
        'email' => 'unique:users,email,' . $user_id . ',user_id',
        'status' => 'required|in:active,inactive',
        'role_id' => 'required|string',
        'is_franchise_owner' => 'required|in:franchise_owner,customer',
        'franchise_id' => 'required|string',
    ]);

    $status = $UserData['status'] === 'active' ? '1' : '0';
    $is_franchise_owner = $UserData['is_franchise_owner'] === 'franchise_owner' ? '1' : '0';

    $UpdateUser = User::where('user_id', $user_id)->first();

    if (!$UpdateUser) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
            'data' => []
        ], 404);
    }

    // Check if a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the previous image
        if ($UpdateUser->image) {
            Storage::delete('public/images/' . $UpdateUser->image);
        }

        // Store the new image
        $image = $request->file('image');
        $filename = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('public/images', $filename); // Store image in storage/app/public/images
        $UpdateUser->image = $filename;
    }

    // Update user data
    $UpdateUser->name = $UserData['name'];
    $UpdateUser->email = $UserData['email'];
    $UpdateUser->status = $status;
    $UpdateUser->role_id = $UserData['role_id'];
    $UpdateUser->is_franchise_owner = $is_franchise_owner;
    $UpdateUser->franchise_id = $UserData['franchise_id'];

    $UpdateUser->save();

    return response()->json([
        'success' => true,
        'message' => 'User updated successfully.',
        'data' => $UserData
    ], 200);
}
/////////view user
public function usersView($user_id){
    $users = User::find($user_id);
if($users){
    return response()->json([
        'success' => true,
        'message' => 'view user',
        'data'=> $users
    ],200);
}
else{
    return response()->json([
        'success' => false,
        'message' => 'Something went wrong.',
    ],401);
}
}

//   ///////////template base
 public function sendLink(Request $request)
 {
     $UserData = $request->validate([
         'email'=>'required|string|email',
     ]);
     $template = '
     <!-- Complete Email template -->
<body style="background-color:grey"> 
	<table align="center" border="0" cellpadding="0" cellspacing="0"
		width="550" bgcolor="white" style="border:2px solid black"> 
		<tbody> 
			<tr> 
				<td align="center"> 
					<table align="center" border="0" cellpadding="0"
						cellspacing="0" class="col-550" width="550"> 
						<tbody> 
							<tr> 
								<td align="center" style="background-color: #4cb96b; 
										height: 50px;"> 
									<a href="#" style="text-decoration: none;"> 
										<p style="color:white; 
												font-weight:bold;"> 
											MyCab 
										</p> 
									</a> 
								</td> 
							</tr> 
						</tbody> 
					</table> 
				</td> 
			</tr> 
			<tr style="height: 300px;"> 
				<td align="center" style="border: none; 
						border-bottom: 2px solid #4cb96b; 
						padding-right: 20px;padding-left:20px"> 
					<p style="font-weight: bolder;font-size: 42px; 
							letter-spacing: 0.025em; 
							color:black;"> 
						My cab 
					</p> 
				</td> 
			</tr> 
			<tr style="display: inline-block;"> 
				<td style="height: 150px; 
						padding: 20px; 
						border: none; 
						border-bottom: 2px solid #361B0E; 
						background-color: white;"> 
					
					<h2 style="text-align: left; 
							align-items: center;"> 
						Forget Password 
				</h2> 
					<p class="data"
					style="text-align: justify-all; 
							align-items: center; 
							font-size: 15px; 
							padding-bottom: 12px;"> 
						Click on given link to change password
					</p> 
					<p> 
						<a href= "#"
						style="text-decoration: none; 
								color:black; 
								border: 2px solid #4cb96b; 
								padding: 10px 30px; 
								font-weight: bold;"> 
						Change password
					</a> 
					</p> 
				</td> 
			</tr> 
		</tbody> 
	</table> 
</body> 

     ';
     $user =  User::where('email', $UserData['email'])->get();
    //  $email=true;

     //email start
   // Set your API key
   $api_key = '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';

   // Endpoint URL
   $endpoint = 'https://api.brevo.com/v3/smtp/email';
   
   // Data to send in the request
   $data = array(
       "sender" => array(
           "name" => "My Cab",
           "email" => "penoo8188@gmail.com"
       ),
       "to" => array(
           array(
               "email" => $UserData['email'],
               "name" => $user[0]->name
           )
       ),
       "subject" => "Change Password",
       "htmlContent" => $template
   );
   
   // Convert data to JSON format
   $data_json = json_encode($data);
   
   // Initialize cURL session
   $ch = curl_init($endpoint);
   
   // Set cURL options
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'accept: application/json',
       'api-key: ' . $api_key,
       'content-type: application/json',
   ));
   
   // Execute cURL request and get the response
   $response = curl_exec($ch);
   
   // Check for cURL errors
   if (curl_errno($ch)) {
       // Handle cURL error here
       echo 'cURL error: ' . curl_error($ch);
   }
   
   // Close cURL session
   curl_close($ch);
   
   // Decode the JSON response
   $result = json_decode($response, true);
   // Check the result

     //email end

    
    if($user->isNotEmpty())
    {
     
     if($result){
         return response()->json([
             'success' => true,
             'message' => 'Link sent, check email.',
         ],200);
     }
     else{
         return response()->json([
             'success' => false,
             'message' => 'Something went wrong',
         ],401);
 
     }
 
    }
    else
    {
     return response()->json([
         'success' => false,
         'message' => 'User does not exist.',
     ],401);
    }
 
        
 }

 public function changePassword(Request $request)
 {
   $UserData = $request->validate([
       'email'=>'required|string',
       'new_password' => 'required|min:6',
       'confirm_password'=>'required|min:6',
   ]);
   // echo '<pre>';print_r($UserData);die();
   $user =  User::where('email', $UserData['email'])->get();
    if($user->isNotEmpty())
    {
     $changePassword = User::where('email', '=', $UserData['email'])->update([    
       'password' => Hash::make($UserData['new_password']),
     ]);
   //   echo '<pre>';print_r($changePassword);die();
   if($UserData){
       return response()->json([
           'success' => true,
           'message' => 'Password updated successfully.'
       ],200);
   }
   else{
       return response()->json([
           'success' => false,
           'message' => 'Something went wrong'
       ],401);

   }
  }
  else
  {
   return response()->json([
       'success' => false,
       'message' => 'user does not exists.',
   ],401);
  }
   
}

public function getUserData()
{
    $users = User::orderBy('user_id', 'desc')->get();
    if ($users->isNotEmpty()) {
        $getUserData = [];

        foreach ($users as $user_row) {
            $getUserData[] = [
                'user_id' => $user_row->user_id,
                'name' => $user_row->name,
                'email' => $user_row->email,
                'status' => $user_row->status,
                'getRollData' => $this->getRollData($user_row->role_id),
                'getPermissionData' => $this->getPermissionData($user_row->permission_id),
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $getUserData
        ],200);
    }

    return null;
}


public function getRollData($role_id)
{

    $role = Role::where('role_id', $role_id)->get();
    if ($role->isNotEmpty()) {
        $getRoleData = [];

        foreach ($role as $role_row) {
            $getRoleData[] = [
                'roll_name' => $role_row->name,
            ];
        }
        return $getRoleData;
    }
    return null;
}


public function getPermissionData($permission_id)
{

    $permission = Permission::where('permission_id', $permission_id)->get();
    if ($permission->isNotEmpty()) {
        $getPermissionData = [];

        foreach ($permission as $permission_row) {
            $getPermissionData[] = [
                'permission_name' => $permission_row->name,
            ];
        }
        return $getPermissionData;
    }
    return null;
}




}


   
  


