<?php

namespace App\Http\Livewire\Backend\Quote;

use App\Models\History\OrderHistory;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile\MyContract;
use App\Models\Quote\OrderQuoteStatus;
use App\Models\Quote\Order;
use App\Models\SidebarOption;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderStatus extends Component
{

	public function render(Request $request)
	{

		$user_id = Auth::guard('Authorized')->user()->id;

		$shipmentDetails = Order::where('user_id', $user_id)
			->select('Customer_Phone', DB::raw('COUNT(*) as shipment_count'), DB::raw('MAX(created_at) as last_shipment_date'))
			->groupBy('Customer_Phone')
			->get()
			->keyBy('Customer_Phone');

		$subQuery = Order::where('user_id', $user_id)
			->select('Customer_Phone', DB::raw('MAX(id) as latest_id'), DB::raw('MIN(created_at) as first_shipment_date'))
			->groupBy('Customer_Phone');

		$Customer_List = Order::joinSub($subQuery, 'unique_phones', fn($join) => $join->on('orders.id', '=', 'unique_phones.latest_id'))
			->orderByDesc('orders.id')
			->paginate($request->input('per_page', 10));

		return view('livewire.backend.quote.customer_list_quote', compact('Customer_List', 'shipmentDetails'))->layout('layouts.authorizedQuote');
	}

	public function QuoteStatus(Request $request)
	{
		// dd($request->all());
		$user_id = Auth::guard('Authorized')->user()->id;

		$check = Order::where('id', $request->quote_id)->where('user_id', $user_id)->pluck('Listing_Status')->first();
		if ($check) {
			Order::where('id', $request->quote_id)
				->where('user_id', $user_id)
				->update([
					'Listing_Status' => $request->history_status,
				]);
		}

		// dd("ok");

		OrderQuoteStatus::create([
			'user_id' => $user_id,
			'order_id' => $request->quote_id,
			'history_status' => $request->history_status,
			'expected_date' => $request->expected_date ?? Carbon::now()->format('Y-m-d'),
			'history_description' => $request->history_description,
		]);

		return redirect()->back()->with('success', 'History added successfully.');
	}

	public function getQuoteStatus(Request $request)
	{
		$listId = $request->input('list_id');
		$quote_status = OrderQuoteStatus::where('order_id', $listId)->orderBy('id', 'DESC')->get();

		// Return a Response object instead of JsonResponse
		$content = json_encode($quote_status);
		return new Response($content, 200, ['Content-Type' => 'application/json']);
	}

	// public function getQuoteStatus(Request $request)
	// {
	//     $listId = $request->input('list_id');

	//     $quote_status = OrderQuoteStatus::where('order_id', $listId)->get();

	//     $responseData = [
	//         'statusHistory' => $quote_status,
	//     ];

	//     $content = json_encode($responseData);
	//     return new Response($content, 200, ['Content-Type' => 'application/json']);
	// }

	// public function Redirection(Request $request)
	// {
	// 	$listId = $request->input('list_id');

	// 	$listingStatus = Order::where('id', $listId)->pluck('Listing_Status')->first();

	// 	$redirectUrl = null;
	//     if ($listingStatus) {
	//         $redirectUrl = route('Custom.Quote.Folder', ['folder' => $listingStatus]);
	//     } else {
	//         $redirectUrl = route('New.Order');
	//     }

	//     $responseData = [ 'redirectUrl' => $redirectUrl ];

	//     $content = json_encode($responseData);

	//     return new Response($content, 200, ['Content-Type' => 'application/json']);

	// }

	public function Redirection(Request $request)
	{
		$listId = $request->input('list_id');

		$listingStatus = Order::where('id', $listId)->pluck('Listing_Status')->first();

		$redirectUrl = null;

		// Check if the status is 'Cancelled'
		if ($listingStatus === 'Cancelled') {
			$redirectUrl = route('Cancelled.Quote');
		} elseif ($listingStatus) {
			$redirectUrl = route('Custom.Quote.Folder', ['folder' => $listingStatus]);
		} else {
			$redirectUrl = route('New.Order');
		}

		$responseData = ['redirectUrl' => $redirectUrl];

		$content = json_encode($responseData);

		return new Response($content, 200, ['Content-Type' => 'application/json']);
	}
}
