<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $slot = '';
        return view('livewire.frontend.testimonials', compact('slot'))->layout('layouts.master');
    }
}
