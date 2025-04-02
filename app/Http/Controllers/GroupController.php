<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\GroupChat;
use App\Models\Auth\AuthorizedAdmin;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Carbon\Carbon;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slot = '';
        $group = Group::orderBy('id','DESC')->paginate(10);
        $user = AuthorizedAdmin::where('id','!=',Auth::guard('Admin')->user()->id)->orderBy('id','DESC')->get();
        // dd($group, $user);
        return view('groups.index',compact('group', 'user', 'slot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logoVal = '';
        if($request->hasFile('logo')) 
        {
            $logVal = 'mimes:jpeg,png,jpg|max:2048';
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'logo' => $logoVal,
            'user.*' => 'required',
        ]);
        // dd('ok', $request->toArray());
        if($validator->passes())
        {
            // dd('oks', $request->toArray());
            $group = new Group;
            $group->name = $request->name;
            $group->description = $request->description;
            $group->user_id = Auth::guard('Admin')->user()->id;
            $group->status = $request->status ? $request->status : 0;
            if($request->hasFile('logo'))
            {
                $destination = 'public/images/group';
                $img = $request->file('logo');
                $logo = 'group-logo'.time().$img->getClientOriginalName();

                $path = $img->storeAs($destination,$logo);
                $group->logo = $logo;
            }
            $group->save();

            if($request->user)
            {
                foreach($request->user as $key => $value)
                {
                    $user = new GroupUser;
                    $user->group_id = $group->id;
                    $user->user_id = $value;
                    $user->status = 0;
                    $user->save();
                }
            }
            $user = new GroupUser;
            $user->group_id = $group->id;
            $user->user_id = Auth::guard('Admin')->user()->id;
            $user->status = 0;
            $user->save();
            return back()->with('flash_message','New group has been created successfully!');
        }
        else 
        {
            return back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Group::with(['users'])->where('id', $id)->first();
        $user= AuthorizedAdmin::where('deleted',0)->where('id','!=',Auth::guard('Admin')->user()->id)->get();
        return response()->json([
            'data'=>$data,
            'user'=>$user,
            'status' => true,
            'status_code' => 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $logoVal = '';
        if($request->hasFile('logo')) 
        {
            $logVal = 'mimes:jpeg,png,jpg|max:2048';
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'logo' => $logoVal,
            'user.*' => 'required',
        ]);
        if($validator->passes())
        {
            $group = Group::find($id);
            $group->name = $request->name;
            $group->description = $request->description;
            $group->user_id = Auth::guard('Admin')->user()->id;
            $group->status = $request->status ? $request->status : 0;
            if($request->hasFile('logo'))
            {
                $destination = 'public/images/group';
                $img = $request->file('logo');
                $logo = 'group-logo'.time().$img->getClientOriginalName();

                $path = $img->storeAs($destination,$logo);
                $group->logo = $logo;
            }
            $group->save();

            if($request->user)
            {
                GroupUser::where('group_id',$id)->delete();
                foreach($request->user as $key => $value)
                {
                    $user = new GroupUser;
                    $user->group_id = $group->id;
                    $user->user_id = $value;
                    $user->status = 0;
                    $user->save();
                }
            }
            $user = new GroupUser;
            $user->group_id = $group->id;
            $user->user_id = Auth::guard('Admin')->user()->id;
            $user->status = 0;
            $user->save();
            return back()->with('flash_message','Group has been updated successfully!');
        }
        else 
        {
            return back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->status = 2;
        $group->save();
        return back()->with('flash_message','Group has been deleted successfully!');
    }
    public function active($id)
    {
        $group = Group::find($id);
        $group->status = 1;
        $group->save();
        return back()->with('flash_message','Group has been activated successfully!');
    }
    public function notActive($id)
    {
        $group = Group::find($id);
        $group->status = 0;
        $group->save();
        return back()->with('flash_message','Group has been non active successfully!');
    }
    public function get_group_chat(Request $request)
    {
        $carbon = Carbon::today()->subDays(30);
        $chat = GroupChat::with(['user'])->where('group_id',$request->groupId)->whereDate('created_at', '>=', $carbon)->get();
        $group = Group::find($request->groupId);
        return view('global_chat.show_group_chat', compact('chat','group'));

    }
    public function get_group_chat_runtime(Request $request)
    {
        $carbon = Carbon::today()->subDays(30);
        $id = Auth::guard('Admin')->user()->id;
        $chat22 = GroupChat::where('group_id',$request->groupId)
        ->whereDate('created_at', '>=', $carbon)
        ->where(function($q)use ($id){
            $q->whereRaw('NOT FIND_IN_SET(?, chat_view_users_id)', [$id])
            ->orWhere('chat_view_users_id',NULL);
        })
        ->get();
        if(count($chat22) > 0)
        {
            $data = [];
            foreach($chat22 as $key => $value)
            {
                foreach(explode(',',$value->chat_view_users_id) as $val)
                {
                    array_push($data,$val);
                }
                array_push($data,$id);
                $data = array_unique($data);
                $groupChat = GroupChat::find($value->id);
                $groupChat->chat_view_users_id = implode(',',$data);
                $groupChat->save();
                $data = [];
                // echo "<pre>";print_r($data);
            }
            $chat = GroupChat::with(['user'])->where('group_id',$request->groupId)->whereDate('created_at', '>=', $carbon)->get();
            $group = Group::find($request->groupId);
            return view('global_chat.show_group_chat', compact('chat','group'));
        }

    }
    public function view_group_chat(Request $request)
    {
        $carbon = Carbon::today()->subDays(30);
        $id = Auth::guard('Admin')->user()->id;
        
        $chat = GroupChat::where('group_id',$request->groupId)
        ->whereDate('created_at', '>=', $carbon)
        ->where(function($q)use ($id){
            $q->whereRaw('NOT FIND_IN_SET(?, chat_view_users_id)', [$id])
            ->orWhere('chat_view_users_id',NULL);
        })
        ->get();
        if($chat)
        {
            $data = [];
            foreach($chat as $key => $value)
            {
                foreach(explode(',',$value->chat_view_users_id) as $val)
                {
                    array_push($data,$val);
                }
                array_push($data,$id);
                $data = array_unique($data);
                $groupChat = GroupChat::find($value->id);
                $groupChat->chat_view_users_id = implode(',',$data);
                $groupChat->save();
                $data = [];
                // echo "<pre>";print_r($data);
            }
        }
        // exit();
    }

    public function save_group_chat(Request $request)
    {
        // dd($request->toArray());
        $id = Auth::guard('Admin')->user()->id;
        if($request->hasFile('img'))
        {
            $destination = 'public/images/group';
            $img = $request->file('img');
            $image_name = 'img-'.time().'-'.$img->getClientOriginalName();
            
            $path = $img->storeAs($destination,$image_name);
            
            $chat = new GroupChat;
            $chat->group_id = $request->group_id;
            $chat->user_id = $id;
            $chat->message = $image_name;
            $chat->type = 'image';
            $chat->chat_view_users_id = $id;
            $chat->save();
        }
        if($request->hasFile('attach'))
        {
            $destination = 'public/file/group';
            $img = $request->file('attach');
            $image_name = 'file-'.time().'-'.$img->getClientOriginalName();
            
            $path = $img->storeAs($destination,$image_name);
            
            $chat = new GroupChat;
            $chat->group_id = $request->group_id;
            $chat->user_id = $id;
            $chat->message = $image_name;
            $chat->type = 'file';
            $chat->chat_view_users_id = $id;
            $chat->save();
        }
        if($request->description2)
        {
            $chat = new GroupChat;
            $chat->group_id = $request->group_id;
            $chat->user_id = $id;
            $chat->message = $request->description2;
            $chat->type = 'text';
            $chat->chat_view_users_id = $id;
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

    public function get_group_name($id)
    {
        $group = Group::find($id);
        return $group->name;
    }
    
    public function get_chat_group_unread(Request $request)
    {
        $carbon = Carbon::today()->subDays(30);
        $id = Auth::guard('Admin')->user()->id;


        $data['alldata'] = GroupChat::select([
            DB::raw('COUNT(group_id) as total_count'),
            'group_id',
            'user_id',
            'message',
            'created_at'
        ])
        ->whereDate('created_at', '>=', $carbon)
        ->where(function($q)use ($id){
            $q->whereRaw('NOT FIND_IN_SET(?, chat_view_users_id)', [$id])
            ->orWhere('chat_view_users_id',NULL);
        })
        ->groupBy('group_id')
        ->get();
        

        foreach ($data['alldata'] as $item) {
                $item->user_id = $this->get_name($item->user_id);
                $item->group_id = $this->get_group_name($item->group_id);
        }

        return json_encode($data);
    }
}
