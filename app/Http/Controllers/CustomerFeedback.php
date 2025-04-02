<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerFeedback extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::guard('Authorized')->user()->id;
        $feedBack = $request->input('feedback');

        Feedback::create([
            'feedback' => $feedBack,
            'user_id' => $currentUser,
        ]);

        return redirect()->back()->with('Success!', 'Feedback submitted successfully!');
    }

    // All Customer Feedbacks Listing on Admin Side
    public function AllCustomerFeedbacks(Request $request)
    {
        $AllFeedBacks = Feedback::with('authorized_user')->get();
        $slot = '';

        return view('livewire.backend.admin.customer_feedback.all_customer_feedbacks', compact('AllFeedBacks', 'slot'));
    }
}
