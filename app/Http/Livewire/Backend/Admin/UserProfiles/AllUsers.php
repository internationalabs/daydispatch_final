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
use Yajra\DataTables\DataTables;

class AllUsers extends Component
{
    public function render()
    {
        return view('livewire.backend.admin.user-profiles.all-users')->layout('layouts.authorized-admin');
    }

    public function getUsersData(Request $request)
{
    $searchTerm = $request->input('search.value');
    $query = AuthorizedUsers::with(['insurance', 'certificates'])->orderBy('id', 'DESC');

    if (!empty($searchTerm)) {
        $query->where(function($q) use ($searchTerm) {
            $q->where('Company_Name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('email', 'LIKE', "%{$searchTerm}%")
              ->orWhere('Mc_Number', 'LIKE', "%{$searchTerm}%")
              ->orWhere('Address', 'LIKE', "%{$searchTerm}%")
            ->orWhereRaw("DATE_FORMAT(created_at, '%M %d, %Y') LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("DATE_FORMAT(updated_at, '%M %d, %Y') LIKE ?", ["%{$searchTerm}%"]);
        });
    }
    
    return DataTables::of($query)
    ->addColumn('Company_Name', function ($User) {
        return $User->Company_Name . '<br>' . 
               ($User->is_email_verified 
                   ? $User->email 
                   : '<span class="text-danger" title="Email Not Verified!">' . $User->email . '</span>') . 
               '<br><a href="#" target="_blank">View MC #' . $User->Mc_Number . '</a><br><strong>' . $User->usr_type . '</strong>';
    })
    ->addColumn('Company Detail', function ($User) {
        return "<strong>Address: </strong>{$User->Address}<br>
                <strong>City: </strong>{$User->Company_City}<br>
                <strong>State: </strong>{$User->Company_State}<br>
                <span class='badge ". ($User->admin_suspended ? 'bg-danger' : '') ."'>" . ($User->admin_suspended ? 'Suspended' : '') . "</span>
                <span class='badge ". (!$User->admin_verify ? 'bg-danger' : '') ."'>" . (!$User->admin_verify ? 'Not Verified!' : '') . "</span>
                <span class='badge ". (!$User->is_email_verified ? 'bg-danger' : '') ."'>" . (!$User->is_email_verified ? 'Email Not Verified!' : '') . "</span>";
    })
    ->addColumn('Contacts', function ($User) {
        return ($User->Contact_Phone ? "<strong>Phone: </strong>{$User->Contact_Phone}<br>" : '') . 
               ($User->Local_Phone ? "<strong>Local: </strong>{$User->Local_Phone}<br>" : '') . 
               ($User->Toll_Free ? "<strong>Toll: </strong>{$User->Toll_Free}<br>" : '') . 
               ($User->Fax_Phone ? "<strong>Fax: </strong>{$User->Fax_Phone}<br>" : '') . 
               ($User->Dispatch_Phone ? "<strong>Dispatch: </strong>{$User->Dispatch_Phone}" : '');
    })
    ->addColumn('Cargo_Detail', function ($User) {
        return ($User->insurance->Agent_Name ?? '<strong class="text-danger">Agent Name?</strong>') . "<br>" . 
               ($User->insurance->Agent_Phone ?? '<strong class="text-danger">Agent Phone?</strong>') . "<br>" . 
               ($User->insurance->Cargo_Limit ?? '<strong class="text-danger">Cargo Ins Limit?</strong>') . "<br>" . 
               ($User->insurance->Deductable ?? '<strong class="text-danger">Cargo Deductible?</strong>');
    })
    // ->addColumn('Created_Updated', function ($User) {
    //     return "";
    // })
    ->addColumn('actions', function ($User) {
        return '<strong>Created At: </strong>' . $User->created_at . '<br><strong>Updated At: </strong>' . $User->updated_at . '<br><div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Actions
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="'.route('Admin.View.Profile', ['User_ID' => $User->id, 'USR_TYPE' => 'User']).'" class="dropdown-item">
                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View Profile
                            </a>
                        </li>
                        '. ($User->admin_suspended ? 
                            '<li><a href="'.route('Un.Suspend.User', ['User_ID' => $User->id]).'" class="dropdown-item">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Mark Un-Suspend
                            </a></li>' :
                            '<li><a href="'.route('Suspend.User', ['User_ID' => $User->id]).'" class="dropdown-item">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Mark Suspend
                            </a></li>' 
                        ) .'
                        <li>
                            <button class="btn get-history" data-bs-toggle="modal" data-bs-target="#showModal">
                                <i class="ri-mail-line align-bottom me-2 text-muted"></i> Authorization Form
                                <input type="hidden" class="user_email" value="'.$User->email.'">
                            </button>
                        </li>
                    </ul>
                </div>';
    })
    ->rawColumns(['Company_Name', 'Company Detail', 'Contacts', 'Cargo_Detail', 'Created_Updated', 'actions'])
    ->make(true);



        // $All_Users = AuthorizedUsers::with([
        //     'insurance',
        //     'certificates'
        // ])->orderBy('id', 'DESC')->paginate(10);

        // return view('livewire.backend.admin.user-profiles.all-users', compact('All_Users'))->layout('layouts.authorized-admin');
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
