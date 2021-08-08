<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Base_Menu;
use App\Models\Base_Persons;
use App\Models\Perimission;
use App\Models\Role;
use App\Models\RolePerimission;
use App\Models\Uni_SubSystems;
use App\Models\User;
use App\Models\UserRole;
use Faker\Provider\Base;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function Index()
    {
//        return(Auth::user()->UserRole->Role->RolePermission);
        $Systems=Uni_SubSystems::all();
        $Role=Role::where('IsDeleted',0)->get();
        $Users=User::where('IsDeleted',0)->paginate(10);
        Paginator::useBootstrap();
        return \view('Users.Users')->with(['Users'=>$Users,'Role'=>$Role,'Sub'=>$Systems]);
    }
    public function Permission(){
        $Systems=Uni_SubSystems::all();
        $Role=Role::where('IsDeleted',0)->paginate(10);
        Paginator::useBootstrap();
        return \view('Users.Permission')->with(['Role'=>$Role,'Sub'=>$Systems]);
    }
    public function GetPermission()
    {
        $Permission=Perimission::all();
        $Array=array();
        foreach ($Permission as $parent)
        {
            if ($parent->ParentId == 0)
            {
                $Temp=array(
                        "id"=>$parent->id,
                        "title"=>$parent->Name,
                        "subs"=>[]
                    );
                foreach ($Permission as $child)
                {
                    if ($child->ParentId == $parent->id)
                    {
                        $ArrayChild=array(
                            "id"=>$child->id,
                            "title"=>$parent->Name.' ('.$child->Name.')',
                        );
                        array_push($Temp['subs'],$ArrayChild);
                    }
                }
                array_push($Array,$Temp);
            }

        }
        return response()->json($Array);
    }
    public function GetRolePermission($Id)
    {
        $Role=Role::find($Id);
        $RolePer=Role::find($Id)->RolePermission;
        $Array=array();
        foreach ($RolePer as $role)
        {
            array_push($Array,$role->PermissionId);
        }
        return response()->json(['Selected'=>$Array, 'Role'=>$Role]);
    }
    public function AddRole(Request $request)
    {
        try {
            $Role = Role::create([
                'ModifyUser'=>Auth::user()->id,
                'Name'=>$request->RoleName,
                'ETitle'=>$request->RoleName,
            ]);
            if ($request->Per)
            {
                foreach ($request->Per as $item) {
                    RolePerimission::create([
                        'ModifyUser'=>Auth::user()->id,
                        'PermissionId'=>$item,
                        'RoleId'=>$Role->id
                    ]);
                }
            }
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function EditRole(Request $request)
    {
        try {
            $Role = Role::find($request->RoleId);
            $Role->Name=$request->RoleName;
            $Role->ModifyUser=Auth::user()->id;
            $Role->save();
            RolePerimission::where('RoleId',$Role->id)->delete();
            if ($request->Per)
            {
                foreach ($request->Per as $item) {
                    RolePerimission::create([
                        'ModifyUser'=>Auth::user()->id,
                        'PermissionId'=>$item,
                        'RoleId'=>$Role->id
                    ]);
                }
            }
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function DeleteRole(Request $request)
    {
        if ($request->RoleId)
        {
            Role::where('id',$request->RoleId)->update([
                'IsDeleted'=>1
            ]);
            RolePerimission::where('RoleId',$request->RoleId)->update([
               'IsDeleted'=>1
            ]);
            return  redirect()->back();
        }
        else{
            return 'false';
        }
    }
    public function EditUser(Request $request)
    {
        $User=User::where('Username',$request->OldUsername)->first();
        $User->Username=$request->Username;
        if ($request->Password)
        {
            $User->password=Hash::make($request->Password);
        }
        $User->save();
        return true;
    }
    public function DeleteUser(Request $request)
    {
        try {
            User::find($request->UserId)->delete();
            UserRole::where('UserId',$request->UserId)->delete();
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return redirect()->back();
        }
    }
    public function UserRole(Request $request)
    {
        UserRole::updateOrCreate(
            ['UserId' => $request->userid],
            ['RoleId' => $request->SelectRole, 'ModifyUser'=>Auth::user()->id]
        );
        return redirect()->back();
    }
    public function SearchPerson(Request $request)
    {
        $Person=Base_Persons::where('NationalCode',$request->NationalCode)->first();
//        do Check
        if ($Person){
            if ($Person->Employee)
            {
                $Person->Employee;
            }
            else if($Person->Student){
                $Person->Student;
            }
        }

        return $Person;
    }
    public function UniqueUsername(Request $request)
    {
//        return $request;
//        return User::where('Username',$request->Username)->count();
        if ($request->Status=='0')
        {
            if(User::where('Username',$request->Username)->first())
            {
                return 0;
            }
            else
            {
                return 1;
            }
        }
        else {
            $User=User::where('Username',$request->Old)->first();
            $C=User::where('Username',$request->Username)->where('id','<>',$User->id)->count();
            if($C>=1)
            {
                return 0;
            }
            else
            {
                return 1;
            }
        }
    }
    public function GetUserRole($id)
    {
        return response()->json(UserRole::where('IsDeleted',0)->where('UserId',$id)->first());
    }
}
