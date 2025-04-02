<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class TestingController extends Controller
{
    public function index(): string
    {
        return 'Testing Controller!!';
    }
    
    public function blogDetails($id)
    {
        $slot = '';
        //echo $id; die();
        return view('livewire.frontend.blog.blogdetail', ['id' => $id, 'slot' => $slot]);
    }
}
