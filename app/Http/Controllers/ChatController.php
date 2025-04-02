<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Extras\MessageNotifications;
use App\Models\Extras\Notification;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Listing\AllUserListing;
use App\Models\Carrier\RequestBroker;

class ChatController extends Controller
{
    public function index(Request $request, $id = null)
    {
        if ($request->has('msg')) {
            $req = RequestBroker::with('authorized_user', 'all_listing', 'requested_user')->find($request->msg);
            // $data = AllUserListing::with([
            //     'request_broker_all' => [
            //         'requested_user' => [
            //             'insurance',
            //             'certificates'
            //         ]
            //     ]
            // ])->whereRelation('request_broker_all', 'order_id', '=', $request->msg)->first();

            // id vname pickup/delivery vcond reqprice
            $id = $req->all_listing->Ref_ID;
            $vehicle_name = $req->all_listing->vehicles[0]->Vehcile_Year . ' ' . $req->all_listing->vehicles[0]->Vehcile_Make . ' ' . $req->all_listing->vehicles[0]->Vehcile_Model;
            $vehicle_cond = $req->all_listing->vehicles[0]->Vehcile_Condition;
            $pickup_loc = $req->all_listing->routes->Origin_ZipCode;
            $delivery_loc = $req->all_listing->routes->Dest_ZipCode;
            $price = $req->Offer_Price;

            $message = new Message;
            $message->user_id = Auth::guard('Authorized')->user()->id;
            $message->recipient_id = $req->requested_user->id;
            $message->content = "Order #: " . $req->all_listing->Ref_ID . "\n" .
                "Vehicle Name: " . $req->all_listing->vehicles[0]->Vehcile_Year . ' ' . $req->all_listing->vehicles[0]->Vehcile_Make . ' ' . $req->all_listing->vehicles[0]->Vehcile_Model . "\n" .
                "Vehicle Condition: " . $req->all_listing->vehicles[0]->Vehcile_Condition . "\n" .
                "Pickup Location: " . $req->all_listing->routes->Origin_ZipCode . "\n" .
                "Delivery Location: " . $req->all_listing->routes->Dest_ZipCode . "\n" .
                "Bid Price: " . $req->Offer_Price;

            $message->save();

            return redirect()->route('chat', ['id' => $req->requested_user->id]);
        }
        // dd($request->msg, $req->toArray(), $id, $vehicle_name, $vehicle_cond, $pickup_loc, $delivery_loc, $price);
        // Check if $id is provided, if not, set default values
        if ($id) {
            $recipient = AuthorizedUsers::find($id);

            // Check if the recipient exists
            if (!$recipient) {
                abort(404); // or handle the case in your own way
            }

            // Get information about the recipient
            $userId = $recipient->id;
            $userName = $recipient->Company_Name;
            $userImage = $recipient->profile_photo_path;
        } else {
            // Set default values when $id is null
            $userId = null;
            $userName = null;
            $userImage = null;
        }

        // Get users with the count of messages
        $users = AuthorizedUsers::with('message')->has('message')->where('id', '!=', Auth::guard('Authorized')->user()->id)->get();

        // Pass the data to the view
        return view('messages.chat', compact('users', 'userId', 'userName', 'userImage'));
    }


    public function getMessagesForUser(AuthorizedUsers $user)
    {
        $messages = Message::with('user')->where(function ($query) use ($user) {
            $query->where('user_id', Auth::guard('Authorized')->user()->id)->where('recipient_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('recipient_id', Auth::guard('Authorized')->user()->id);
        })->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'recipient_id' => 'required|exists:authorized_users,id',
        ]);

        $user = Auth::guard('Authorized')->user();
        $recipientId = $request->input('recipient_id');

        $message = new Message([
            'user_id' => $user->id,
            'recipient_id' => $recipientId,
            'content' => $request->input('content'),
        ]);

        $recipient = AuthorizedUsers::find($request->recipient_id);

        $message->save();

        $Notification = new MessageNotifications();
        $Notification->notification = 'Your Have A New Message From ' . $user->Company_Name;
        $Notification->chat_id = $message->id;
        $Notification->user_id = $user->id;
        $Notification->recipient_id = $recipientId;
        $Notification->save();

        return response()->json(['user_id' => $user->id, 'message' => 'Message sent successfully']);
    }


    public function readMessage($id)
    {
        try {
            // Validate or cast $id to ensure it's an appropriate data type (e.g., integer).
            $id = (int) $id;

            // Check if the record exists, and throw an exception if not found.
            $status = MessageNotifications::where('chat_id', $id)->first();

            // Update the is_read status.
            $status->is_read = 1;
            $status->save();

            return back();
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Message not found.');
        }
    }
}
