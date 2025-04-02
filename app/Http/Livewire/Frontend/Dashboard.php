<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Extras\InstantQoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Listing\AllUserListing;
use App\Mail\InstantQuoteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        // Retrieve the authenticated user
        // $user = Auth::guard('Authorized')->user();
        
        // // Generate an access token for the user
        // // $accessToken = $user->createToken('AuthToken');
        // $accessToken = $user->createToken('Token Name')->accessToken;

        // $accessToken = $accessToken->token;
        $accessToken = '';

        // dd($accessToken, $accessToken->token);

        $allUserListing = new AllUserListing();

        $Listing_I = $allUserListing->getListingByType(1, 'vehicles');
        $Listing_II = $allUserListing->getListingByType(2, 'heavy_equipments');
        $Listing_IV = $allUserListing->getListingByType(2, 'heavy_equipments', true);
        $Listing_III = $allUserListing->getListingByType(3, 'dry_vans');
        $Listing_V = $allUserListing->getListingByType(3, 'dry_vans', true);

        return view('livewire.frontend.dashboard', compact('Listing_I', 'Listing_II', 'Listing_III', 'Listing_IV', 'Listing_V', 'accessToken'))->layout('layouts.master');
    }

    public function postInstantQuote(Request $request): string
    {
        // dd($request->all());
        $InstantQuote = new InstantQoute();
        $InstantQuote->From_ZipCode = $request->From_ZipCode;
        $InstantQuote->To_ZipCode = $request->To_ZipCode;
        $InstantQuote->Select_Vehicle = $request->Select_Vehicle;
        $InstantQuote->Car_Make = $request->Car_Make;
        $InstantQuote->Car_Model = $request->Car_Model;
        $InstantQuote->Year_Make_Model = $request->Year_Make_Model;
        $InstantQuote->Additional_Instruction = $request->Additional_Instruction;
        $InstantQuote->Vehicle_Length = $request->Vehicle_Length;
        $InstantQuote->Vehicle_Width = $request->Vehicle_Width;
        $InstantQuote->Vehicle_Height = $request->Vehicle_Height;
        $InstantQuote->Vehicle_Weight = $request->Vehicle_Weight;
        $InstantQuote->Carrier_Type = $request->Carrier_Type;
        $InstantQuote->Carrier_Condition = $request->Carrier_Condition;
        $InstantQuote->Custo_Name = $request->Custo_Name;
        $InstantQuote->Custo_Email = $request->Custo_Email;
        $InstantQuote->Custo_Phone = $request->Custo_Phone;
        if ($request->has('Shipping_Mode') && $request->Shipping_Mode != null) {
            # code...
            $InstantQuote->Shipping_Mode = $request->Shipping_Mode;
        }
        if ($request->has('Equipment_Type') && $request->Equipment_Type != null) {
            # code...
            $InstantQuote->Equipment_Type = implode(',', $request->Equipment_Type);
        }
        if ($request->has('Trailer') && $request->Trailer != null) {
            # code...
            $InstantQuote->Trailer = implode(',', $request->Trailer);
        }
        if ($request->has('Freight_Weight') && $request->Freight_Weight != null) {
            # code...
            $InstantQuote->Freight_Weight = $request->Freight_Weight;
        }
        if ($request->has('Shipment_Preferences') && $request->Shipment_Preferences != null) {
            # code...
            $InstantQuote->Shipment_Preferences = $request->Shipment_Preferences;
        }
        if ($request->has('Pickup_Date') && $request->Pickup_Date != null) {
            # code...
            $InstantQuote->Pickup_Date = $request->Pickup_Date;
        }
        if ($request->has('Delivery_Date') && $request->Delivery_Date != null) {
            # code...
            $InstantQuote->Delivery_Date = $request->Delivery_Date;
        }
        if ($request->has('Pickup_Time') && $request->Pickup_Time != null) {
            # code...
            $InstantQuote->Pickup_Time = $request->Pickup_Time;
        }
        if ($request->has('Delivery_Time') && $request->Delivery_Time != null) {
            # code...
            $InstantQuote->Delivery_Time = $request->Delivery_Time;
        }
        if ($request->has('Pickup_Services') && $request->Pickup_Services != null) {
            # code...
            $InstantQuote->Pickup_Services = implode(',', $request->Pickup_Services);
        }
        if ($request->has('Delivery_Services') && $request->Delivery_Services != null) {
            # code...
            $InstantQuote->Delivery_Services = implode(',', $request->Delivery_Services);
        }
        $Year_Make_Model = $request->Year_Make_Model;
        $Select_Vehicle = $request->Select_Vehicle;

        // Save to the sender project's database
        if ($InstantQuote->save()) {
            // Send the form data to the receiver project
            // $receiverProjectUrl = 'http://washington.shawntransport.com/api/submit-instant-quote';
            // $response = Http::post($receiverProjectUrl, ['json' => $request->all()]);
            // $response = Http::post('http://washington.shawntransport.com/api/submit-instant-quote', [
            //     'data' => $request->all(),
            // ]);
            // $response = Http::post('https://washington.shawntransport.com/api/submit-instant-quote', array(
            //     'headers' => array('Content-type' => 'application/json'),
            //     'body' => $request->all(),
            // ));

            $response = Http::post('https://washington.shawntransport.com/api/submit-instant-quote-DD', [
                'headers' => ['Content-type' => 'application/json'],
                'json' => $request->all(),
            ]);

            // dd('sas', $response->json());

            // Check if the request was successful in the receiver project
            if ($response->successful()) {
                // Send the email and return success message
                // $Year_Make_Model = $request->Year_Make_Model;
                // $Select_Vehicle = $request->Select_Vehicle;
                Mail::to($request->Custo_Email)->send(new InstantQuoteMail($Year_Make_Model, $Select_Vehicle));
                return "Your Quotation Submitted Successfully";
            } else {
                // Handle the case when the receiver project's API call fails
                return "Your Quotation Submitted in the sender project, but failed to submit in the receiver project";
            }
        }

        // If saving to the sender project's database fails
        return "Your Quotation Not Submitted";
    }
}


// public function postInstantQuoteApi(Request $request): string
// {
//     $data = $request->only([
//         'From_ZipCode', 'To_ZipCode', 'Select_Vehicle', 'Car_Make', 'Car_Model',
//         'Year_Make_Model', 'Additional_Instruction', 'Vehicle_Length', 'Vehicle_Width',
//         'Vehicle_Height', 'Vehicle_Weight', 'Carrier_Type', 'Carrier_Condition',
//         'Custo_Name', 'Custo_Email', 'Custo_Phone', 'Shipping_Mode', 'Equipment_Type',
//         'Trailer', 'Freight_Weight', 'Shipment_Preferences', 'Pickup_Date', 'Delivery_Date',
//         'Pickup_Time', 'Delivery_Time', 'Pickup_Services', 'Delivery_Services'
//     ]);

//     $data['Equipment_Type'] = implode(',', $request->input('Equipment_Type', []));
//     $data['Trailer'] = implode(',', $request->input('Trailer', []));
//     $data['Pickup_Services'] = implode(',', $request->input('Pickup_Services', []));
//     $data['Delivery_Services'] = implode(',', $request->input('Delivery_Services', []));

//     $InstantQuote = InstantQoute::create($data);

//     $Year_Make_Model = $request->input('Year_Make_Model');
//     $Select_Vehicle = $request->input('Select_Vehicle');

//     if ($InstantQuote) {
//         Mail::to($request->input('Custo_Email'))->send(new InstantQuoteMail($Year_Make_Model, $Select_Vehicle));
//         return "Your Quotation Submitted Successfully!";
//     }

//     return "Your Quotation Not Submitted";
// }
