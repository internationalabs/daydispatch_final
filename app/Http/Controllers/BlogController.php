<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payments\SubscriptionPackages;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $slot = '';
        return view('livewire.frontend.blog.index', compact('slot'))->layout('layouts.master');
    }
}