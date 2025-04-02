<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\AuthorizedAdmin;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupChat;
use App\Models\chat;
use App\Models\Message;
use App\Models\Auth\AuthorizedUsers;
use App\role;
use App\zipcodes;
use Session;
use Redirect;
use Hash;
use Mail;
use Auth;
use DB;
use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;

class AdminChatController extends Controller
{
    public function index()
    {
        $chatID = '';
        $chatText = 'Chat';
        $id= Auth::guard('Admin')->user()->id;
        $data = AuthorizedAdmin::where('id', '!=', Auth::guard('Admin')->user()->id);
        
        if(Auth::guard('Admin')->user()->role_id != 1)
        {
            $data = $data->where('role',Auth::guard('Admin')->user()->role_id)->orWhere('role',1);
        }
        
        $data = $data->orderBy('updated_at','DESC')->get();
        
        $group = Group::select(['id','name','logo'])
        ->with(['chatOne:message,group_id,user_id,created_at,type','chatOne.user:id,name'])
        ->whereHas('users',function($q) use ($id){
            $q->where('user_id',$id)->where('status',0);
        })->where('status',1)->get();

        $carbon = Carbon::today()->subDays(31);
        if($group)
        {
            foreach($group as $key => $value)
            {
                $group[$key]->count = 0;
                $count = GroupChat::where('group_id',$value->id)->whereDate('created_at', '>=', $carbon)
                ->where(function ($q) use ($id){
                    $q->whereRaw('NOT FIND_IN_SET(?, chat_view_users_id)', [$id])
                    ->orWhere('chat_view_users_id',NULL);
                })
                ->count();

                $group[$key]->count = $count;
            }
        }

        return view('global_chat.index', compact('data','group','chatText','chatID'));

    }
    
    public function index3($chatID)
    {
        $chatText = 'Chat';
        $id= Auth::guard('Admin')->user()->id;
        $data = AuthorizedAdmin::where('id', '!=', Auth::guard('Admin')->user()->id);
        
        if(Auth::guard('Admin')->user()->role_id != 1)
        {
            $data = $data->where('role',Auth::guard('Admin')->user()->role_id)->orWhere('role',1);
        }
        
        $data = $data->orderBy('updated_at','DESC')->get();
        
        $group = Group::select(['id','name','logo'])
        ->with(['chatOne:message,group_id,user_id,created_at,type','chatOne.user:id,name'])
        ->whereHas('users',function($q) use ($id){
            $q->where('user_id',$id)->where('status',0);
        })->where('status',1)->get();

        $carbon = Carbon::today()->subDays(31);
        if($group)
        {
            foreach($group as $key => $value)
            {
                $group[$key]->count = 0;
                $count = GroupChat::where('group_id',$value->id)->whereDate('created_at', '>=', $carbon)
                ->where(function ($q) use ($id){
                    $q->whereRaw('NOT FIND_IN_SET(?, chat_view_users_id)', [$id])
                    ->orWhere('chat_view_users_id',NULL);
                })
                ->count();

                $group[$key]->count = $count;
            }
        }

        return view('global_chat.index', compact('data','group','chatText','chatID'));
    }
    
    public function index22(Request $request)
    {
        $chatText = $request->chatText;
        $id= Auth::guard('Admin')->user()->id;
        $data = AuthorizedAdmin::where('id', '!=', Auth::guard('Admin')->user()->id);
        
        if(Auth::guard('Admin')->user()->role_id != 1)
        {
            $data = $data->where('role',Auth::guard('Admin')->user()->role_id)->orWhere('role_id', 1);
        }
        
        $data = $data->orderBy('updated_at','DESC')->get();
        
        $group = Group::select(['id','name','logo'])
        ->with(['chatOne:message,group_id,user_id,created_at,type','chatOne.user:id,name'])
        ->whereHas('users',function($q) use ($id){
            $q->where('user_id',$id)->where('status',0);
        })->where('status',1)->get();

        $carbon = Carbon::today()->subDays(31);
        if($group)
        {
            foreach($group as $key => $value)
            {
                $group[$key]->count = 0;
                $count = GroupChat::where('group_id',$value->id)->whereDate('created_at', '>=', $carbon)
                ->where(function ($q) use ($id){
                    $q->whereRaw('NOT FIND_IN_SET(?, chat_view_users_id)', [$id])
                    ->orWhere('chat_view_users_id',NULL);
                })
                ->count();

                $group[$key]->count = $count;
            }
        }

        return view('global_chat.chat-list', compact('data','group','chatText'));

    }
    
    public function readMsgs(Request $request)
    {
        chat::where(function($q) use ($request){
            $q->where('fromuserId',$request->touserId)
                ->where('touserId',Auth::guard('Admin')->user()->id);
        })->update(['chat_view2'=>1]);
        
        return "Read";
    }

    public function get_chat(Request $request)
    {
        $carbon = Carbon::today()->subDays(2);
        
        $data = chat::where(function($q) use ($request){
            $q->where(function ($q1) use ($request){
                $q1->where('touserId',$request->touserId)
                ->where('fromuserId',Auth::guard('Admin')->user()->id);
            })
            ->orWhere(function ($q1) use ($request){
                $q1->where('fromuserId',$request->touserId)
                ->where('touserId',Auth::guard('Admin')->user()->id);
            });
        })->whereDate('created_at', '>=', $carbon)
        ->orderBy('created_at','ASC')
        ->get();
        
        $user = AuthorizedAdmin::find($request->touserId);

        return view('global_chat.show_chat', compact('data','user'));
    }


    public function get_chat_runtime(Request $request)
    {
        $carbon = Carbon::today()->subDays(2);
        
        $data22 = chat::where(function($q) use ($request){
            $q->where(function ($q1) use ($request){
                $q1->where('touserId',$request->touserId)
                ->where('fromuserId',Auth::guard('Admin')->user()->id);
            })
            ->orWhere(function ($q1) use ($request){
                $q1->where('fromuserId',$request->touserId)
                ->where('touserId',Auth::guard('Admin')->user()->id);
            });
        })->whereDate('created_at', '>=', $carbon)
        ->where('chat_view2', '=', 0)
        ->orderBy('created_at','ASC')
        ->get();
        
        if(count($data22) > 0)
        {
            foreach($data22 as $key => $val)
            {
                $chat = chat::find($val->id);
                $chat->chat_view2 = 1;
                $chat->save();
            }
            $data = chat::where(function($q) use ($request){
                $q->where(function ($q1) use ($request){
                    $q1->where('touserId',$request->touserId)
                    ->where('fromuserId',Auth::guard('Admin')->user()->id);
                })
                ->orWhere(function ($q1) use ($request){
                    $q1->where('fromuserId',$request->touserId)
                    ->where('touserId',Auth::guard('Admin')->user()->id);
                });
            })->whereDate('created_at', '>=', $carbon)
            ->orderBy('created_at','ASC')
            ->get();
            
            $user = AuthorizedAdmin::find($request->touserId);
    
            return view('global_chat.show_chat', compact('data','user'));
        }
    }

    public function get_chat2(Request $request)
    {
        $uid = Auth::guard('Admin')->user()->id;
        $data = chat::where('touserId', '=', Auth::guard('Admin')->user()->id)->where('chat_view2', '=', 0)->orderby('created_at', 'desc')->get();
        return view('global_chat.show_chat', compact('data'));
    }


    public function view_chat(Request $request)
    {
        $uid = Auth::guard('Admin')->user()->id;
        $data = chat::where('touserId', '=', Auth::guard('Admin')->user()->id)->where('chat_view2', '=', 0)->orderby('created_at', 'desc')->get();
        if (!empty($data)) {
            $data2 = DB::update("update chats set chat_view2 = 1 where touserId = $uid");
        }
    }


    public function view_chat_timer(Request $request)
    {
        $uid = Auth::guard('Admin')->user()->id;
        $data = chat::where('touserId', '=', Auth::guard('Admin')->user()->id)->where('chat_view2', '=', 0)->orderby('created_at', 'desc')->count();
        return $data;
    }

    public function save_chat(Request $request)
    {
        if($request->hasFile('img'))
        {
            $destination = 'public/images/chat';
            $img = $request->file('img');
            $image_name = 'img-'.time().'-'.$img->getClientOriginalName();
            
            $path = $img->storeAs($destination,$image_name);
            
            $chat = new chat();
            $chat->touserId = $request->to_user_id;
            $chat->fromuserId = Auth::guard('Admin')->user()->id;
            $chat->description = $image_name;
            $chat->type = 'image';
            $chat->chat_view = 1;
            $chat->save();
        }
        if($request->hasFile('attach'))
        {
            $destination = 'public/file/chat';
            $img = $request->file('attach');
            $image_name = 'file-'.time().'-'.$img->getClientOriginalName();
            
            $path = $img->storeAs($destination,$image_name);
            
            $chat = new chat();
            $chat->touserId = $request->to_user_id;
            $chat->fromuserId = Auth::guard('Admin')->user()->id;
            $chat->description = $image_name;
            $chat->type = 'file';
            $chat->chat_view = 1;
            $chat->save();
        }
        if($request->description)
        {
            $chat = new chat();
            $chat->touserId = $request->to_user_id;
            $chat->fromuserId = Auth::guard('Admin')->user()->id;
            $chat->description = $request->description;
            $chat->type = 'text';
            $chat->chat_view = 1;
            $chat->save();
        }
        redirect('/chats');
        return "SUCCESS";
    }

    public function get_name($id)
    {
        $user = AuthorizedAdmin::find($id);
        $name = $user->name;
        return $name;
    }

    public function get_chat_unread(Request $request)
    {
        $uid =Auth::guard('Admin')->user()->id;

        $data['alldata'] = DB::SELECT("SELECT COUNT(fromuserId) as total_count,fromuserId,touserId,description,created_at FROM chats WHERE chat_view2 = 0 and touserId = '$uid' GROUP by fromuserId");

        foreach ($data['alldata'] as $item) {
                $item->fromuserId = $this->get_name($item->fromuserId);
        }

        return json_encode($data);
    }
    
    public function chatNoti()
    {
        $carbon = Carbon::today()->subDays(31);
        $id = Auth::guard('Admin')->user()->id;
        
        $getchat = DB::table('chats')
                ->where('touserId', Auth::guard('Admin')->user()->id)
                ->where('chat_view2', 0)
                ->whereDate('created_at', '>=', Carbon::today()->subDays(2))
                ->orderby('created_at', 'desc')
                ->limit(100)
                ->get();
            
        $getGroupChat = GroupChat::with(['user','group'])
        ->whereHas('group.users',function($q) use ($id){
            $q->where('user_id',$id)->where('status',0);
        })
        ->whereDate('created_at', '>=', $carbon)
        ->where(function ($q) use ($id){
            $q->whereRaw('NOT FIND_IN_SET(?, chat_view_users_id)', [$id])
            ->orWhere('chat_view_users_id',NULL);
        })
        ->orderby('created_at', 'desc')
        ->limit(100)
        ->get();
        
        return view('global_chat.chat-noti',compact('getchat','getGroupChat'));
    }
    
    public function chatNotiCount()
    {
        $carbon = Carbon::today()->subDays(31);
        $id = Auth::guard('Admin')->user()->id;
        
        $getchat = DB::table('chats')
                ->where('touserId', Auth::guard('Admin')->user()->id)
                ->where('chat_view2', 0)
                ->orderby('created_at', 'desc')
                ->whereDate('created_at', '>=', Carbon::today()->subDays(2))
                ->count();
            
        $getGroupChat = GroupChat::whereHas('group.users',function($q) use ($id){
            $q->where('user_id',$id)->where('status',0);
        })
        ->whereDate('created_at', '>=', $carbon)
        ->where(function ($q) use ($id){
            $q->whereRaw('NOT FIND_IN_SET(?, chat_view_users_id)', [$id])
            ->orWhere('chat_view_users_id',NULL);
        })
        ->orderby('created_at', 'desc')
        ->count();
        
        $count = $getchat + $getGroupChat;
        
        return response()->json([
            'count'=>$count,
            'status'=>true,
            'status_code'=>200
        ],200);
        
    }


    // User Chat
    public function userChats()
    {
        $data = AuthorizedUsers::whereHas('message', function ($query) {
            $query->where('recipient_id', 100);
        })
        ->with(['message' => function ($query) {
            $query->where('recipient_id', 100)
                  ->orderBy('created_at', 'desc');
        }])
        ->get();
            
        return view('global_chat.user-chat-index', compact('data'));
    }

    // User Chat
    public function userChats22()
    {
        $data = AuthorizedUsers::whereHas('message', function ($query) {
            $query->where('recipient_id', 100);
        })
        ->with(['message' => function ($query) {
            $query->where('recipient_id', 100)
                  ->orderBy('created_at', 'desc');
        }])
        ->get();
            
        return view('global_chat.user-chat-list', compact('data'));
    }

    public function user_get_chat(Request $request)
    {
        $carbon = Carbon::today()->subDays(2);
        
        $data = Message::where(function($q) use ($request){
            $q->where(function ($q1) use ($request){
                $q1->where('user_id',$request->touserId)
                ->where('recipient_id',100);
            })
            ->orWhere(function ($q1) use ($request){
                $q1->where('recipient_id',$request->touserId)
                ->where('user_id',100);
            });
        })
        // ->whereDate('created_at', '>=', $carbon)
        ->orderBy('created_at','ASC')
        ->get();
        
        $user = AuthorizedAdmin::find(1);
        $user2 = AuthorizedUsers::find($request->touserId);

        return view('global_chat.user_show_chat', compact('data','user','user2'));
    }

    public function user_get_chat_runtime(Request $request)
    {
        $carbon = Carbon::today()->subDays(2);

        $data22 = Message::where(function($q) use ($request){
            $q->where(function ($q1) use ($request){
                $q1->where('recipient_id',$request->touserId)
                ->where('user_id',100);
            })
            ->orWhere(function ($q1) use ($request){
                $q1->where('user_id',$request->touserId)
                ->where('recipient_id',100);
            });
        })
        // ->whereDate('created_at', '>=', $carbon)
        ->orderBy('created_at','ASC')
        ->get();
        
        if(count($data22) > 0)
        {
            $data = Message::where(function($q) use ($request){
                $q->where(function ($q1) use ($request){
                    $q1->where('recipient_id',$request->touserId)
                    ->where('user_id',100);
                })
                ->orWhere(function ($q1) use ($request){
                    $q1->where('user_id',$request->touserId)
                    ->where('recipient_id',100);
                });
            })
            // ->whereDate('created_at', '>=', $carbon)
            ->orderBy('created_at','ASC')
            ->get();
            
            $user = AuthorizedAdmin::find(1);
            $user2 = AuthorizedUsers::find($request->touserId);
    
            return view('global_chat.user_show_chat', compact('data','user','user2'));
        }
    }

    public function user_save_chat(Request $request)
    {
        if($request->description)
        {
            $message = new Message();
            $message->recipient_id = $request->to_user_id;
            $message->user_id = 100;
            $message->content = $request->description;
            $message->save();
        }
        redirect('/chats');
        return "SUCCESS";
    }
}
