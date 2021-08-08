<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\DB;
class MessengerController extends Controller
{
    public function Index()
    {
        $message=Message::where('from_id',Auth::user()->id)->orWhere('to_id',Auth::user()->id)->orderBy('created', 'ASC')->get();
//        return [$message,Auth::user()->id];
        return view('Messenger')->with(['Message'=>$message]);
    }
    public function SendMessage(Request $request)
    {
//        return $request;
        $AdminId=0;
        $UserRole=UserRole::all();
        foreach ($UserRole as $item) {
            if ($item->Role->Name=='سوپر ادمین'){
                $AdminId=$item->UserId;
            }
        }
//        return $request;
        $messageID=mt_rand(9, 999999999) + time();
        if ($request->to_id=='Admin')
        {
            $users=User::all();
            foreach ($users as $user) {
                $messageID=mt_rand(9, 999999999) + time();
                Message::create([
                    'id'=>$messageID,
                    'type'=>'admin',
                    'from_id'=>$AdminId,
                    'to_id'=>$user->id,
                    'body'=>$request->Message,
                    'created'=>(string)Jalalian::now()
                ]);
            }
        }else{
            if ($request->to_id!=0){
                $newMessage=Message::create([
                    'id'=>$messageID,
                    'type'=>'user',
                    'from_id'=>$AdminId,
                    'to_id'=>$request->to_id,
                    'body'=>$request->Message,
                    'created'=>(string)Jalalian::now()
                ]);
            }else{
                $newMessage=Message::create([
                    'id'=>$messageID,
                    'type'=>'user',
                    'from_id'=>Auth::user()->id,
                    'to_id'=>$AdminId,
                    'body'=>$request->Message,
                    'created'=>(string)Jalalian::now()
                ]);
            }
        }
        return ['true',Message::where(['id'=>$messageID])->first()];
    }
//  Admin Access to this function
    public function GetContacts()
    {
//        $users=User::all();
//        $messages=Message::all();
//        $Contacts=array();
//        foreach ($users as $user) {
//            foreach ($messages as $message) {
////                return $message;
//                if ($message->from_id==$user->id && $message->to_id==$user->id)
//                {
//                    $user->Person;
//                    array_push($Contacts,$user);
//                }
//            }
////            if ($user->Messages){
////                $user->Messages->groupBy('from_id');
////                Auth::user()->id;
////            }
////            else if();
//        }
        $AdminId=0;
        $UserRole=UserRole::all();
        foreach ($UserRole as $item) {
            if ($item->Role->Name=='سوپر ادمین'){
                $AdminId=$item->UserId;
            }
        }
        $message=Message::orderBy('created','desc')->groupBy('from_id')->having('from_id', '<>', $AdminId)->get();
//        $message=Message::orderBy('created','desc')->groupBy('from_id')->get();
//        $message=Message::orderBy('created','desc')->groupBy('to_id')->get();
        foreach ($message as $item) {
            $item->User->Person;
            if ($item->to_id!='0')
            {
                $item->UserTo->Person;
            }
        }
        return response()->json($message);
    }

    public function GetContactMessage(Request $request)
    {
        $message=Message::where('from_id',$request->from_id)->orWhere('to_id',$request->from_id)->orderBy('created', 'ASC')->get();
        return response()->json($message);
    }

    public function GetAllContacts()
    {
        $AdminId=0;
        $UserRole=UserRole::all();
        foreach ($UserRole as $item) {
            if ($item->Role->Name=='سوپر ادمین'){
                $AdminId=$item->UserId;
            }
        }
        $user=array();
        $contants=User::all();
        foreach ($contants as $contant) {
            if ($contant->UserRole->Role->Name!='سوپر ادمین') {
                $contant->Person;
                array_push($user,$contant);
            }
        }
        return response()->json($user);
    }

    public function GetAllMessageToUser()
    {
        $Mes=Message::where('type','Admin')->groupBy('created')->get();
        return response()->json($Mes);
    }
    public function DeleteMessage(Request $request)
    {
        Message::where('id',$request->messageId)->delete();
        return response()->json('true');
    }
    public function DeleteAllMessage(Request $request)
    {
        $Message=Message::find($request->messageId);
        Message::where('created',$Message->created)->delete();
        return response()->json('true');
    }
}
