<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Messages;
use App\Groups;
use App\GroupMessages;
use App\Listeners\ChatEvent;

class MessagesController extends Controller
{
    public function index($id){
      $group = DB::table('group_messages')->where('users_id',$id)->first();
      $message = DB::table('messages')->where('group_id',$group->id)->get();
      return  view('chat',compact('message'));
    }
    public function admin($id){
        $group = DB::table('group_messages')->where('users_id',$id)->first();
        $message = DB::table('messages')->where('group_id',$group->id)->orderBy('id','desc')->paginate(5);
        return  response()->json($message);
    }
    public function postSend(Request $req){
        // dd(Auth::user()->name);
        // $user = DB::table('users')->where('id',$id)->first();
        // $check = DB::table('group_messages')->where('users_id',$id)->first();
        // if(!$check){
        //     DB::table('group_messages')->insert([
        //         'users_id' => $id,
        //         'id_admin' => 1,
        //      ]);
        // }
        // $group = DB::table('group_messages')->where('users_id',$id)->first();
    	$message = Messages::create([
            'group_id' =>$req->channel,
            'author' => Auth::user()->name,
            'messages' => $req->messages,
        ]);
    	event(
    		$e  = new ChatEvent($message)
    	);
    	return response()->json($message);
    }
    public function adminPostSend(Request $req,$id){
        $group = DB::table('group_messages')->where('id',$id)->first();
        $message = Messages::create([
            'group_id' =>$id,
            'author' => 'Admin',
            'messages' => $req->content,
        ]);
        event(
            $e  = new ChatEvent($message)
        );
        return response()->json($message);
    }
    public function getAddGroup(){
        return view('addGroup');
    }
    public function postAddGroup(Request $req)
    {
        $groups = new Groups();
        $groups->name = $req->channel;
        $groups->type_group = $req->type_group;
        $groups->save();

        return redirect()->route('home');
    }
    public function joinGroup($channel){
        $type_group = DB::table('groups')->where('id','=',$channel)->select('groups.type_group')->first();
        if($type_group->type_group === 1){
            $check_group_user = DB::table('group_messages')->where([
                ['users_id','=',Auth::user()->id],
                ['group_id','=',$channel]
            ])->first();
            if($check_group_user === null){
                $group_user = new GroupMessages(); 
                $group_user->group_id = $channel;
                $group_user->users_id = Auth::user()->id;
                $group_user->save();
            }
            $messages = DB::table('messages')->where('group_id',$channel)->get();
            // dd($messages);
            return  view('socket',compact('channel','messages'));
        }else if($type_group->type_group === 0){
            $user_qty = DB::table('group_messages')->where([
                ['group_id','=',$channel],
                ['users_id','!=',Auth::user()->id]
                ])->count();
            if($user_qty >= 2){
                $error ="Kênh đã đủ người";
                return redirect()->route('home')->with('error',$error);
            }else{
                $check_group_user = DB::table('group_messages')->where([
                    ['users_id','=',Auth::user()->id],
                    ['group_id','=',$channel]
                ])->first();
                if($check_group_user === null){
                    $group_user = new GroupMessages(); 
                    $group_user->group_id = $channel;
                    $group_user->users_id = Auth::user()->id;
                    $group_user->save();
                }
                $messages = DB::table('messages')->where('group_id',$channel)->get();
                // dd($messages);
                return  view('socket',compact('channel','messages'));
            }

        }
    }

}
