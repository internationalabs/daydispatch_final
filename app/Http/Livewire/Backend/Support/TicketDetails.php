<?php

namespace App\Http\Livewire\Backend\Support;

use App\Models\Support\TicketComments;
use App\Services\OrderSupport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TicketDetails extends Component
{
    protected OrderSupport $orderSupport;
    public $auth_user;

    public function mount(OrderSupport $orderSupport): void
    {
        $this->orderSupport = $orderSupport;
        $this->auth_user = Auth::guard('Authorized')->user();
    }

    public function render(Request $request)
    {
        $Ticket = $this->orderSupport->getTicketDetail($request->Ticket_ID);
        return view('livewire.backend.support.ticket-details', compact('Ticket'))->layout('layouts.payment');;
    }

    public function PostComments(Request $request): RedirectResponse
    {
        $TicketComments = new TicketComments();
        $TicketComments->Comments = $request->Comments;
        $TicketComments->user_id = Auth::guard('Authorized')->user()->id;
        $TicketComments->ticket_id = $request->ticket_id;
        if ($TicketComments->save()) {
            return redirect()->route('Ticket.Details', ['Ticket_ID' => $request->ticket_id])->with('Success!', "Your Comment has been Posted!");
        }
        return back()->with('Error!', "Comment Not Posted!");
    }

    public function TicketAttachment(Request $request): RedirectResponse
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $Certificate = $request->file('Attachments');
        $fileName = $request->Attachments_Type . '_' . $user_id . '.' . $Certificate->extension();
        $Certificate->move(public_path('Uploads/Tickets/' . $user_id . '/'), $fileName);
        $Path_Certificate = 'Uploads/Tickets/' . $user_id . '/' . $fileName;

        $insertQuery = "INSERT INTO `ticket_attachments`(`Doc_Name`, `profile_photo_path`, `user_id`, `ticket_id`, `created_at`, `updated_at`) VALUES
                            ('" . $request->Attachments_Type . "', '" . $Path_Certificate . "', '" . $user_id . "', '" . $request->ticket_id . "', '" . now() . "', '" . now() . "')";

        if (DB::insert($insertQuery)) {
            return redirect()->route('Ticket.Details', ['Ticket_ID' => $request->ticket_id])->with('Success!', "Your Files has been Uploaded!");
        }
        return back()->with('Error!', "Files Not Uploaded!");
    }
}
