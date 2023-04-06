<?php
namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\UpdateInformationUser;

class UserController extends Controller
{

    // activate user
    public function activate($id)
    {
        $Users =  User::findOrFail($id);
        if ($Users->status == "Active")
        {
            $Users->status = "Inactive";
        }
        else
        {
            $Users->status ="Active";
        }
        $Users->save();

        return redirect()->route('Users.index')->with('message','User Updated Status Successfully');
    }

    // get profile page
    public function getProfile()
    {
        return view ('Pages.Users.profile');
    }

    // update profile user
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
        ]);

        $id                    =  Auth::user()->id;
        $Users                 =  User::findOrFail($id);
        $Users->name           = $request->name;
        $Users->gender         = $request->gender;
        $Users->material_status= $request->material_status;
        $Users->firstname      = $request->firstname;
        $Users->lastname       = $request->lastname;
        $Users->email          = $request->email;
        $Users->phone          = $request->phone;

        if ($request->file('photo'))
        {
            $destinationPath = 'Profile/';
            $files = $request->file('photo');
            $file_name = time().$files->getClientOriginalName();
            $files->move($destinationPath , $file_name);
            $path =  env('APP_URL');
            $Image = $path.'/'.$destinationPath.$file_name;
            $Users->photo = $Image;
        }

        $Users->save();

        Notification::send($Users, new UpdateInformationUser($Users));

        return redirect()->route('getProfile')->with('info','Data update Successfully');
    }


    // get Reset Password Page
    public function resetPassword()
    {
        return view('Pages.Users.changepassword');
    }

    // update Password
    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'new_password' => 'required|confirmed',
            ]);

            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back()->with('message','Data added Successfully');
            }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    // get all users from Database
    public function index()
    {
        $Users = User::orderBy('id','DESC')->get();
        $roles = Role::pluck('name','name')->all();

        return view('Pages.Users.index',compact('Users' , 'roles'));

    }

    // store user in database with validations in request
    public function store(StoreUser $request)
    {
        try {
            $Users = new User();
            $Users->name           = $request->name;
            $Users->password       = Hash::make($request->password);
            $Users->gender         = $request->gender;
            $Users->material_status= $request->material_status;
            $Users->status         = $request->status;
            $Users->firstname      = $request->firstname;
            $Users->lastname       = $request->lastname;
            $Users->email          = $request->email;
            $Users->phone          = $request->phone;
            $Users->role_id          = 1;

            if ($request->file('photo'))
            {
                $destinationPath = 'Profile/';
                $files = $request->file('photo');
                $file_name = time().$files->getClientOriginalName();
                $files->move($destinationPath , $file_name);
                $path =  env('APP_URL');
                $Image = $path.'/'.$destinationPath.$file_name;
                $Users->photo = $Image;
            }

            $Users->save();
            $Users->assignRole($request->input('roles_name'));

            return redirect()->route('Users.index')->with('message','Data added Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    // update user in database with validations in request
    public function update(StoreUser $request)
    {
        try {
            $Users = User::findOrFail($request->id);

            $Users->name           = $request->name;
            if(!empty($request->password))
            {
                $Users->password       = Hash::make($request->password);
            }
            $Users->gender         = $request->gender;
            $Users->material_status= $request->material_status;
            $Users->role_id        = $request->role_id;
            $Users->status         = $request->status;
            $Users->firstname      = $request->firstname;
            $Users->lastname       = $request->lastname;
            $Users->email          = $request->email;
            $Users->phone          = $request->phone;
            $Users->role_id        = 1 ;

            $Users->save();

            DB::table('model_has_roles')->where('model_id',$Users->id)->delete();
            $Users->assignRole($request->input('roles'));

           return redirect()->route('Users.index')->with('info','Data update Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    // delete user from database by id
    public function destroy(Request $request)
    {
        try {
            $Users = User::findOrFail($request->id)->delete();

            return redirect()->route('Users.index')->with('warning','Data delete Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
