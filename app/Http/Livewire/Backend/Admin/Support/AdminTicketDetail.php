<?php

namespace App\Http\Livewire\Backend\Admin\Support;

use App\Models\Support\ThreeWayTicket;
use App\Models\Support\TicketComments;
use App\Services\OrderSupport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;

class AdminTicketDetail extends Component
{
    protected OrderSupport $orderSupport;

    public function mount(OrderSupport $orderSupport): void
    {
        $this->orderSupport = $orderSupport;
    }

    public function render(Request $request)
    {
        $Ticket = $this->orderSupport->getTicketDetail($request->Ticket_ID);
        return view('livewire.backend.admin.support.admin-ticket-detail', compact('Ticket'))->layout('layouts.authorized-admin');
    }

    public function PostComments(Request $request): RedirectResponse
    {
        $TicketComments = new TicketComments();
        $TicketComments->Comments = $request->Comments;
        $TicketComments->ticket_id = $request->ticket_id;
        if ($TicketComments->save()) {
            return redirect()->route('Admin.Ticket.Details', ['Ticket_ID' => $request->ticket_id])->with('Success!', "Your Comment has been Posted!");
        }
        return back()->with('Error!', "Comment Not Posted!");
    }

    public function PostCommentsReplied(Request $request): RedirectResponse
    {
        TicketComments::where(
            [
                'id' => $request->get_Comment_ID,
                'ticket_id' => $request->ticket_id,
            ])->update([
            'Comments_Replied' => $request->Comments_Replied
        ]);
        return redirect()->route('Admin.Ticket.Details', ['Ticket_ID' => $request->ticket_id])->with('Success!', "Your Comment has been Posted!");
    }

    public function TicketStatusUpdate(Request $request): string
    {
        $output = 'Ajax Call Not Received';
        if ($request->ajax()) {
            ThreeWayTicket::where(
                [
                    'id' => $request->ticket_id,
                ])->update([
                'status' => $request->Ticket_Status
            ]);
            $output = 'Ticket Status Got Updated!';
        }
        return $output;
    }
}
