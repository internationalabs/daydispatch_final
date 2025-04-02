<?php

namespace App\Http\Livewire\Backend\Profile;

use App\Models\Extras\Notification;
use App\Models\Extras\MessageNotifications;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyNotifications extends Component
{
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;

        // $Notifications = Notification::where('user_id', $user_id)->where('is_read', 0)->orderBy('id', 'DESC')->get();
        $Notifications = Notification::where(function ($query) use ($user_id) {
            $query->where('user_id', $user_id)
                ->orWhereHas('order', static function ($query) use ($user_id) {
                    $query->where('user_id', $user_id)->where('is_read', 0);
                });
        })
            ->where('is_read', 0)
            ->latest('id')
            ->get();
        $msg = MessageNotifications::where('recipient_id', $user_id)->where('is_read', 0)->orderBy('id', 'DESC')->get();
        return view('livewire.backend.profile.my-notifications', compact('Notifications', 'msg'))->layout('layouts.authorized');
    }

    public function deleteNotification(Request $request): RedirectResponse
    {
        Notification::find(id: $request->notify_id)->delete();
        return back()->with('Success!', "Deleted Successfully!");
    }

    public function markRead(Request $request): RedirectResponse
    {
        $user_id = Auth::guard('Authorized')->user()->id;

        if ($request->notify_id == 'all') {
            // Notification::where('user_id', Auth::guard('Authorized')->user()->id)
            // ->update([
            //     'is_read' => 1
            // ]);
            Notification::where(function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
                $query->orWhereHas('order', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id)->where('is_read', 0);
                });
            })
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        } else {
            Notification::where('id', $request->notify_id)
                ->update([
                    'is_read' => 1
                ]);
        }

        return back()->with('Success!', "Marked Read Successfully!");
    }
}
