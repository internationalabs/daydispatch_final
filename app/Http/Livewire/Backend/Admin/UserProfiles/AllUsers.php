<?php

namespace App\Http\Livewire\Backend\Admin\UserProfiles;

use App\Models\Auth\AuthorizedUsers;
use App\Models\AuthorizationForm;
use App\Models\AuthorizationFormImages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Mail\AuthorizationFormMail;
use App\Models\Listing\AllUserListing;
use Livewire\WithPagination;

class AllUsers extends Component
{
    public function render()
    {
        $All_Users = AuthorizedUsers::with([
            'insurance',
            'certificates'
        ])->orderBy('id', 'DESC')->paginate(10);

        return view('livewire.backend.admin.user-profiles.all-users', compact('All_Users'))->layout('layouts.authorized-admin');
    }

    public function VerifyUser(Request $request): RedirectResponse
    {
        $User = AuthorizedUsers::where('id', $request->User_ID)->first();
        $User->admin_verify = 1;
        $User->Profile_Update = 1;
        $User->is_email_verified = 1;
        if ($User->update()) {
            return back()->with('Success!', "User Verification Done!");
        } else {
            return back()->with('Error!', "User Didn't Verify!");
        }
    }

    public function un_VerifyUser(Request $request): RedirectResponse
    {
        $User = AuthorizedUsers::where('id', $request->User_ID)->first();
        $User->admin_verify = 0;
        if ($User->update()) {
            return back()->with('Success!', "User Un-Verify Done!");
        } else {
            return back()->with('Error!', "User Didn't Verify!");
        }
    }

    public function SuspendUser(Request $request): RedirectResponse
    {
        $User = AuthorizedUsers::where('id', $request->User_ID)->first();
        $User->admin_suspended = 1;
        if ($User->update()) {
            return redirect()->route('All.Users')->with('Success!', "User Suspended Mark Done!");
        } else {
            return back()->with('Error!', "User Didn't Suspended!");
        }
    }

    public function un_SuspendUser(Request $request): RedirectResponse
    {
        $User = AuthorizedUsers::where('id', $request->User_ID)->first();
        $User->admin_suspended = 0;
        if ($User->update()) {
            return redirect()->route('All.Users')->with('Success!', "User Un-Suspended Mark Done!");
        } else {
            return back()->with('Error!', "User Didn't Suspended!");
        }
    }

    public function authorizationForm(Request $request)
    {
        return view('livewire.backend.admin.user-profiles.authorizationForm')->layout('layouts.authorized-admin');
    }

    public function authorizationFormSubmit(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $validatedData = $request->validate([
            'date' => ['required', 'date'],
            'company_name' => ['required', 'string'],
            'email' => ['nullable', 'string'],
            'card_holders' => ['required', 'string'],
            'billing_address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'zip_code' => ['required', 'string'],
            'country' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'card' => ['nullable', 'string'],
            'card_number' => ['nullable', 'string'],
            'expdate' => ['nullable', 'date_format:Y-m'],
            'Code' => ['nullable', 'string'],
            'issuing_bank' => ['nullable', 'string'],
            'bank_approval' => ['nullable', 'string'],
            'card_issuer' => ['nullable', 'string'],
            'invoice' => ['nullable', 'string'],
            'invoice_amount' => ['nullable', 'string'],
            'signatureData' => ['nullable', 'string'],
        ]);
    
    
        try {
            // Create a new instance of the AuthorizationForm model
            $authorizationForm = new AuthorizationForm;
    
            // Set the attributes of the model with the values from the request
            $authorizationForm->fill($validatedData);
    
            // Associate the form data with the authenticated user
            // $authorizationForm->user_id = Auth::user()->id;
    
            // Save the model to the database
            $authorizationForm->save();
    
            // Save multiple images associated with the form
            if ($request->hasFile('multiImage') && $request->file('multiImage') != null) {
                $images = $request->file('multiImage');
    
                foreach ($images as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
    
                    // Save the image to the storage path
                    $image->storeAs('authorization_form_images', $imageName, 'public');
    
                    // Create a new instance of AuthorizationFormImages model
                    $formImage = new AuthorizationFormImages;
    
                    // Set attributes of the model
                    $formImage->form_id = $authorizationForm->id;
                    $formImage->image = $imageName;
                    $formImage->status = 1; // You can set a default status
    
                    // Save the image model to the database
                    $formImage->save();
                }
            }
    
            // Add a flash message for success
            return redirect()->back()->with('success', 'Form submitted successfully!');
        } catch (\Exception $e) {
            // Return error response
            return redirect()->back()->with('error', 'Failed to store form data. ' . $e->getMessage());
        }
    }

    public function authorizationFormEmail(Request $request)
    {
        // dd($request->toArray());
        // Extracting values from the request with default values set to null
        $cID = $request->input('id', null);
        $cname = $request->input('cname', null);
        $cphone = $request->input('cphone', null);
        $invoiceAmount = $request->input('invoiceAmount', null);
        $origin = $request->input('origin', null);
        $destination = $request->input('destination', null);
        $vehicle = $request->input('vehicle', null);
    
        // Ensure the email field is present in the request
        $email = $request->input('email');
        if (!$email) {
            // Handle the case where email is null or not present
            return response()->json(['error' => 'Email field is required'], 400);
        }
        
        // Generate a unique invoice number (e.g., letters + $cID)
        // $invoiceNo = $this->generateUniqueInvoice($cID);
        
        // dd($cID, $cname, $cphone, $email, $invoiceNo, $invoiceAmount);
    
        // Assuming the Mail facade is properly set up
        
        Mail::to('abst99856@gmail.com')->send(new AuthorizationFormMail());
        // Mail::to('abst99856@gmail.com')->send(new AuthorizationFormMail());

        return back();
    }

    public function allForms()
    {
        if(Auth::guard('Admin')->check())
        {
            $slot = '';
            $form = AuthorizationForm::orderBy('id', 'DESC')->get();
            return view('livewire.backend.admin.user-profiles.allForms',compact('form', 'slot'))->layout('layouts.authorized-admin');
        }
        else
        {
            return redirect('/login');
        }
    }
    
    public function show($id)
    {
        $slot = '';
        if(Auth::guard('Admin')->check()) {
            $form = AuthorizationForm::with('images')->find($id);
    
            // Check if the form exists
            if (!$form) {
                return response()->json(['error' => 'Authorization Form not found'], 404);
            }
    
            // You might want to further check if ymk, origincity, etc. properties exist on $order before accessing them
    
            return view('livewire.backend.admin.user-profiles.showAuthorization', compact('form', 'slot'));
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function MoveToListing(Request $request)
    {
    $Listed_ID = $request->List_ID;
    $user_id = Auth::guard('Authorized')->user()->id;

    $privatelisting = AllUserListing::where('id', $Listed_ID)
        ->where('user_id', $user_id)
        ->where('Private_Listing', 1)
        ->where('Listing_Status', 'Draft')
        ->first();
        
    if (!$privatelisting) {
        return redirect()->route('User.Listing')->with('error', "Listing not found or not private.");
    }

    $privatelisting->Private_Listing = 0;
    $privatelisting->Listing_Status = 'Listed';

    if ($privatelisting->save()) { // Use save() instead of update()
        return redirect()->route('User.Listing')->with('success', "Your listing has been published.");
    }

    return redirect()->route('User.Listing')->with('error', "Failed to update listing.");
    }

}
