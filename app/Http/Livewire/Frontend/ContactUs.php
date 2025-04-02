<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Frontend\ContactLead;
use Illuminate\Http\Request;
use Livewire\Component;

class ContactUs extends Component
{
    public function render()
    {
        return view('livewire.frontend.contact-us')->layout('layouts.master');
    }

    public function postContactLead(Request $request): string
    {
        $ContactUs = new ContactLead();
        $ContactUs->Lead_Name = $request->Lead_Name;
        $ContactUs->Lead_Email = $request->Lead_Email;
        $ContactUs->Lead_Phone = $request->Lead_Phone;
        $ContactUs->Lead_Subject = $request->Lead_Subject;
        $ContactUs->Lead_Message = $request->Lead_Message;

        if ($ContactUs->save()) {
            return "Your Request has been Submitted Successfully!";
        }
        return "Your Request Not Submitted";
    }
}
