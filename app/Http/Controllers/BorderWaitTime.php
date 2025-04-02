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

class BorderWaitTime extends Controller
{
    public function index()
    {
        $slot = "";
        return view('borderWaitTime.index', compact('slot'));
    }
}
