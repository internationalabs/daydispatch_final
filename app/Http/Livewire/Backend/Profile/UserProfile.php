<?php

namespace App\Http\Livewire\Backend\Profile;

use Exception;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Profile\UserCertificates;
use App\Models\Profile\UserInsurrance;
use App\Models\Profile\MyNetwork;
use App\Models\Profile\MyContract;
use App\Models\Profile\AddressBook;
use App\Models\Profile\AddDispute;
use App\Models\Profile\DisputesFiles;
use App\Models\UserEquipmentType;
use App\Models\UserSetting;
use function strtotime;
use App\Models\CertificateAssign;
use Faker\Core\File;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Component
{
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $User_Info = AuthorizedUsers::with(["insurance", "certificates", "address_Book", "contract", "myContracts", "myEquipments"])->where('id', $user_id)->firstOrFail();
        $all_user = AuthorizedUsers::get();

        // $Selected_Certificates_assigns = CertificateAssign::with('certificate_assigns')->where('user_id', $user_id)->get();

        $Selected_Certificates_assigns = CertificateAssign::where('user_id', Auth::guard('Authorized')->user()->id)->get();
        
        // $Selected_Certificates_assigns = CertificateAssign::get();

        // dd($Selected_Certificates_assigns->toArray());

        $My_Networks = DB::table('my_networks')
            ->join('authorized_users', 'my_networks.CMP_ID', '=', 'authorized_users.id')
            ->where('my_networks.user_id', '=', $user_id)
            ->select('my_networks.*', 'authorized_users.profile_photo_path', 'authorized_users.Company_Name', 'authorized_users.usr_type')
            ->get();

        return view('livewire.backend.profile.user-profile', compact('User_Info', 'My_Networks', 'all_user', 'Selected_Certificates_assigns'))->layout('layouts.authorized');
    }

    public function UserCertificateAssign(Request $request)
    {
        
        dd($request->toArray(), $request->insurance_companies);
        // Retrieve input data
        $certificateId = $request->input('certificate_id');
        $companies = $request->input('companies');
        $USDOT_Certificate = $request->input('certificate_name');

        // Delete existing records for the given certificate_id and certificate_name
        CertificateAssign::where('certificate_id', $certificateId)
            ->where('certificate_name', $USDOT_Certificate)
            ->delete();

        // Prepare data for new records
        // dd($companies, $request->toArray());
        
        $data = [];
        foreach ($companies as $userId) {
            $data[] = [
                'certificate_id' => $certificateId,
                'user_id' => $userId,
                'certificate_name' => $USDOT_Certificate,
            ];
        }

        // Insert new records
        CertificateAssign::insert($data);

        return redirect()->back()->with('success', 'Companies assigned to certificate successfully.');
    }

    /**
     * @throws Exception
     */
    // public function UpdateUserProfile(Request $request): RedirectResponse
    // {
    //     // dd($request->all());
    //     try {
    //         DB::beginTransaction();

    //         $user_id = Auth::guard('Authorized')->user()->id;
    //         $User_Info = AuthorizedUsers::where('id', $user_id)->first();

    //         $User_Info->name = $request->User_Name;
    //         $User_Info->Local_Phone = $request->Local_Phone;
    //         $User_Info->Toll_Free = $request->Toll_Free;
    //         $User_Info->Fax_Phone = $request->Fax_Phone;
    //         $User_Info->Dispatch_Phone = $request->Dispatch_Phone;
    //         $User_Info->Contact_Method = $request->Contact_Method;
    //         $User_Info->Website_Url = $request->Website_URL;
    //         $User_Info->Time_Zone = $request->Time_Zone;
    //         $User_Info->Hours_Operations = $request->Hours_Operations;
    //         if ($request->has('Number_of_Trucks') && $request->Number_of_Trucks != null) {
    //             # code...
    //             $User_Info->Number_of_Trucks = $request->Number_of_Trucks;
    //         }
    //         if ($request->has('Equipment_Type') && $request->Equipment_Type != null) {
    //             # code...
    //             $User_Info->Equipment_Type = $request->Equipment_Type;
    //         }
    //         if ($request->has('Equipment_Description') && $request->Equipment_Description != null) {
    //             # code...
    //             $User_Info->Equipment_Description = $request->Equipment_Description;
    //         }
    //         if ($request->has('Route_Description') && $request->Route_Description != null) {
    //             # code...
    //             $User_Info->Route_Description = $request->Route_Description;
    //         }
    //         $User_Info->Profile_Update = 1;

    //         if ($request->hasFile('Profile_Image')) {
    //             $ProfileImage = $request->file('Profile_Image');
    //             $imageName = 'Profile_Image_' . $user_id . '.' . $ProfileImage->extension();
    //             $ProfileImage->move(public_path('Uploads/Profile/' . $user_id . '/'), $imageName);
    //             $User_Info->profile_photo_path = 'Uploads/Profile/' . $user_id . '/' . $imageName;

    //             if ($ProfileImage) {
    //                 if ($User_Info->update()) {
    //                     $User_Insurance = UserInsurrance::where('user_id', $user_id)->first();
    //                     $User_Insurance->Expiration_Date = $request->Expiration_Date;
    //                     $User_Insurance->Cargo_Limit = $request->Carg_Limit;
    //                     $User_Insurance->Deductable = $request->Deductible;
    //                     $User_Insurance->Auto_Policy_Number = $request->Policy_Number;
    //                     $User_Insurance->Cargo_Policy_Number = $request->Cargo_Number;
    //                     $User_Insurance->Agent_Name = $request->Agent_Name;
    //                     $User_Insurance->Agent_Phone = $request->Agent_Phone;

    //                     if ($User_Insurance->update()) {
    //                         $User_Certificates = UserCertificates::where('user_id', $user_id)->first();

    //                         $Insurance_Certificate = $request->file('Insurance_Certificate');
    //                         $Insurance_fileName = 'Insurance_Certificate_' . $user_id . '.' . $Insurance_Certificate->extension();
    //                         $Insurance_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $Insurance_fileName);
    //                         $User_Certificates->Insurance_Certificate = 'Uploads/Certificates/' . $user_id . '/' . $Insurance_fileName;

    //                         $WNine_Certificate = $request->file('WNine_Certificate');
    //                         $WNine_fileName = 'W9_Certificate_' . $user_id . '.' . $WNine_Certificate->extension();
    //                         $WNine_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $WNine_fileName);
    //                         $User_Certificates->W_Nine = 'Uploads/Certificates/' . $user_id . '/' . $WNine_fileName;

    //                         $USDOT_Certificate = $request->file('USDOT_Certificate');
    //                         $USDOT_fileName = 'W9_Certificate_' . $user_id . '.' . $USDOT_Certificate->extension();
    //                         $USDOT_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $USDOT_fileName);
    //                         $User_Certificates->USDOT_Certificate = 'Uploads/Certificates/' . $user_id . '/' . $USDOT_fileName;

    //                         if ($request->file('Business_License')) {
    //                             $Business_License = $request->file('Business_License');
    //                             $Lic_fileName = 'W9_Certificate_' . $user_id . '.' . $Business_License->extension();
    //                             $Business_License->move(public_path('Uploads/Certificates/' . $user_id . '/'), $Lic_fileName);
    //                             $User_Certificates->Business_License = 'Uploads/Certificates/' . $user_id . '/' . $Lic_fileName;
    //                         }

    //                         if ($Insurance_Certificate && $WNine_Certificate && $USDOT_Certificate) {
    //                             if ($User_Certificates->update()) {
    //                                 DB::commit();
    //                                 return redirect()->route('User.Profile')->with('Success!', "Your Profile has been Updated.");
    //                             }

    //                             throw new \RuntimeException('User Certificates Not Inserted');
    //                         }

    //                         throw new \RuntimeException('User Certificates Not Uploaded');
    //                     }

    //                     throw new \RuntimeException('User Insurance Not Updated');
    //                 }

    //                 throw new \RuntimeException('User Profile Not Updated');
    //             }
    //         }
    //         return redirect()->route('User.Profile')->with('Success!', "Your Profile has been Updated.");
    //         // throw new \RuntimeException('User Profile Image Not Updated');
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         throw new \RuntimeException($e->getMessage());
    //     }
    // }
    public function UpdateUserProfile(Request $request): RedirectResponse
    {
        // dd($request->all());

        DB::beginTransaction();
        
        try {
            $user_id = Auth::guard('Authorized')->user()->id;
            $User_Info = AuthorizedUsers::where('id', $user_id)->first();
            
            // Update User Info
            $User_Info->name = $request->User_Name;
            $User_Info->Local_Phone = $request->Local_Phone;
            $User_Info->Toll_Free = $request->Toll_Free;
            $User_Info->Fax_Phone = $request->Fax_Phone;
            $User_Info->Dispatch_Phone = $request->Dispatch_Phone;
            $User_Info->Contact_Method = $request->Contact_Method;
            $User_Info->Website_Url = $request->Website_URL;
            $User_Info->Time_Zone = $request->Time_Zone;
            $User_Info->Hours_Operations = $request->Hours_Operations;
            $User_Info->Mc_Number = $request->MC_Number;
            $User_Info->Company_USDot = $request->Dot_Number;

            $User_Info->Company_Name = $request->Company_Name;
            $User_Info->Address = $request->Address;
            $User_Info->Dispatch_Contact = $request->Dispatch_Person;
            $User_Info->Contact_Phone = $request->Listing_Phone;
            if($request->Notification_Email){
                $User_Info->notification_email = $request->Notification_Email;
            }
            
            if ($request->has('Number_of_Trucks')) {
                $User_Info->Number_of_Trucks = $request->Number_of_Trucks;
            }

            // $User_Info->Equipment_Type = $request->Equipment_Type;
            if ($request->has('Equipment_Type')) {
                $equipmentTypes = $request->Equipment_Type;
                
                UserEquipmentType::where('user_id', $user_id)->delete();
                
                foreach ($equipmentTypes as $equipment) {
                    UserEquipmentType::create([
                        'user_id' => $user_id,
                        'equipment' => $equipment,
                    ]);
                }
            }

            if ($request->has('Equipment_Description')) {
                $User_Info->Equipment_Description = $request->Equipment_Description;
            }

            if ($request->has('Route_Description')) {
                $User_Info->Route_Description = $request->Route_Description;
            }

            $User_Info->Profile_Update = 1;

            if ($request->hasFile('Profile_Image')) {
                $ProfileImage = $request->file('Profile_Image');
                $imageName = 'Profile_Image_' . $user_id . '.' . $ProfileImage->extension();
                $ProfileImage->move(public_path('Uploads/Profile/' . $user_id . '/'), $imageName);
                $User_Info->profile_photo_path = 'Uploads/Profile/' . $user_id . '/' . $imageName;
            }

            if ($request->hasFile('Cover_Image')) {
                $CoverImage = $request->file('Cover_Image');
                $CoverimageName = 'Cover_Image_' . $user_id . '.' . $CoverImage->extension();
                $CoverImage->move(public_path('Uploads/Cover/' . $user_id . '/'), $CoverimageName);
                $User_Info->cover_photo = 'Uploads/Cover/' . $user_id . '/' . $CoverimageName;
            }

            $User_Info->save(); // Save User Info regardless of file upload

            // Update User Insurance
            $User_Insurance = UserInsurrance::where('user_id', $user_id)->first();
            $User_Insurance->Expiration_Date = $request->Expiration_Date;
            $User_Insurance->Cargo_Limit = $request->Carg_Limit;
            $User_Insurance->Deductable = $request->Deductible;
            $User_Insurance->Auto_Policy_Number = $request->Policy_Number;
            $User_Insurance->Cargo_Policy_Number = $request->Cargo_Number;
            $User_Insurance->Agent_Name = $request->Agent_Name;
            $User_Insurance->Agent_Phone = $request->Agent_Phone;
            $User_Insurance->save(); // Save Insurance Info

            // Update User Insurance
            $User_Setting = UserSetting::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'email_notification' => $request->email_notification ?? 0,
                    'custom_notification' => $request->custom_notification ?? 0,
                    'prefer_vehicle' => $request->prefer_vehicle ?? 0,
                    'prefer_heavy' => $request->prefer_heavy ?? 0,
                    'prefer_dryvan' => $request->prefer_dryvan ?? 0,
                ]
            );

            // Update User Certificates
            $User_Certificates = UserCertificates::where('user_id', $user_id)->first();

            if ($request->hasFile('Insurance_Certificate')) {
                $Insurance_Certificate = $request->file('Insurance_Certificate');
                $Insurance_fileName = 'Insurance_Certificate_' . $user_id . '.' . $Insurance_Certificate->extension();
                $Insurance_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $Insurance_fileName);
                $User_Certificates->Insurance_Certificate = 'Uploads/Certificates/' . $user_id . '/' . $Insurance_fileName;
            }

            if ($request->hasFile('WNine_Certificate')) {
                $WNine_Certificate = $request->file('WNine_Certificate');
                $WNine_fileName = 'W9_Certificate_' . $user_id . '.' . $WNine_Certificate->extension();
                $WNine_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $WNine_fileName);
                $User_Certificates->W_Nine = 'Uploads/Certificates/' . $user_id . '/' . $WNine_fileName;
            }

            if ($request->hasFile('USDOT_Certificate')) {
                $USDOT_Certificate = $request->file('USDOT_Certificate');
                $USDOT_fileName = 'USDOT_Certificate_' . $user_id . '.' . $USDOT_Certificate->extension();
                $USDOT_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $USDOT_fileName);
                $User_Certificates->USDOT_Certificate = 'Uploads/Certificates/' . $user_id . '/' . $USDOT_fileName;
            }

            if ($request->hasFile('Business_License')) {
                $Business_License = $request->file('Business_License');
                $Lic_fileName = 'Business_License_' . $user_id . '.' . $Business_License->extension();
                $Business_License->move(public_path('Uploads/Certificates/' . $user_id . '/'), $Lic_fileName);
                $User_Certificates->Business_License = 'Uploads/Certificates/' . $user_id . '/' . $Lic_fileName;
            }

            $User_Certificates->save(); // Save Certificates Info

            DB::commit();
            return redirect()->route('User.Profile')->with('Success!', "Your Profile has been Updated.");
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('User.Profile')->withErrors(['error' => $e->getMessage()]);
        }
    }

    // User Notification Update
    public function UpdateUserNotification(Request $request): RedirectResponse
    {
        // dd($request->all());

        DB::beginTransaction();
        
        try {
            $user_id = Auth::guard('Authorized')->user()->id;
            
            $User_Setting = UserSetting::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'email_notification' => $request->has('email_notification') ? 1 : 0,
                    'custom_notification' => $request->has('custom_notification') ? 1 : 0,
                ]
            );

            DB::commit();
            return redirect()->route('User.Profile')->with('Success!', "Your Notification has been Updated.");
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('User.Profile')->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function addNewContact(Request $request): RedirectResponse
    {
        try {
            $user_id = Auth::guard('Authorized')->user()->id;

            DB::beginTransaction();

            $AddressBook = new AddressBook();
            $AddressBook->CMP_Name = $request->CMP_Name;
            $AddressBook->First_Name = $request->CMP_First_Name;
            $AddressBook->Last_Name = $request->CMP_Last_Name;
            $AddressBook->CMP_Address = $request->CMP_Email;
            // $AddressBook->Buyer_Number = $request->Buyer_Number;
            // $AddressBook->CMP_City = $request->CMP_City;
            // $AddressBook->CMP_Postal_Code = $request->Postal_Code;
            $AddressBook->CMP_Phone_Number = $request->Phone_Number;
            $AddressBook->Title = $request->CMP_Title;
            // $AddressBook->CMP_Phone_Number_I = $request->CMP_Phone_I;
            // $AddressBook->CMP_Phone_Number_II = $request->CMP_Phone_II;
            $AddressBook->user_id = $user_id;
            if ($AddressBook->save()) {
                DB::commit();
                return redirect()->route('User.Profile')->with('Success!', "Contact Added to Your Address Book.");
            }

            DB::rollBack();
            return back()->with('Error!', "404 Bad Request. Contact not Added!");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while processing the request. Contact not Added!");
        }
    }

    public function deleteContact(Request $request): RedirectResponse
    {
        try {
            $user_id = Auth::guard('Authorized')->user()->id;

            DB::beginTransaction();

            AddressBook::where('id', $request->contact_id)->where('user_id', $user_id)->delete();

            DB::commit();
            return redirect()->route('User.Profile')->with('Success!', "Contact Deleted From Your Address Book.");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while processing the request. Contact not Deleted!");
        }
    }

    public function addMyContract(Request $request): RedirectResponse
    {
        // dd($request->toArray());
        try {
            $user_id = Auth::guard('Authorized')->user()->id;

            DB::beginTransaction();

            if ($request->has('contract_id')) {
                $MyContract = MyContract::find($request->contract_id);
                if (!is_null($MyContract)) {
                    $MyContract->My_Contract = $request->My_Contract;
                    $MyContract->contractName = $request->contractName;
                    $MyContract->user_id = $user_id;

                    if ($MyContract->update()) {
                        DB::commit();
                        return redirect()->route('User.Profile')->with('Success!', "Your Contract Updated.");
                    }

                    DB::rollBack();
                    return back()->with('Error!', "404 Bad Request. Contract not Updated!");
                }
            } else {
                $MyContract = new MyContract();
                $MyContract->My_Contract = $request->My_Contract;
                $MyContract->contractName = $request->contractName;
                $MyContract->user_id = $user_id;
            }



            if ($MyContract->save()) {
                DB::commit();
                return redirect()->route('User.Profile')->with('Success!', "Your Contract Saved.");
            }

            DB::rollBack();
            return back()->with('Error!', "404 Bad Request. Contract not Saved!");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while processing the request. Contract not Saved!");
        }
    }

    public function addMyNetwork(Request $request): RedirectResponse
    {
        try {
            $user_id = Auth::guard('Authorized')->user()->id;
            $business_type = Auth::guard('Authorized')->user()->usr_type;

            DB::beginTransaction();

            $MyNetwork_check = MyNetwork::where('CMP_ID', $request->CMP_ID)->where('Business_Type', $business_type)->where('user_id', $user_id)->first();
            if (is_null($MyNetwork_check) && $request->CMP_ID !== $user_id) {
                $MyNetwork = new MyNetwork();
                $MyNetwork->My_Network = $request->CMP_Find;
                $MyNetwork->CMP_ID = $request->CMP_ID;
                $MyNetwork->Business_Type = $business_type;
                $MyNetwork->user_id = $user_id;

                if ($MyNetwork->save()) {
                    DB::commit();
                    return redirect()->route('User.Profile')->with('Success!', "Your Network Saved.");
                }

                DB::rollBack();
                return back()->with('Error!', "404 Bad Request. Network not Saved!");
            }

            DB::rollBack();
            return back()->with('Error!', "This Network is Already in Your Preferred List!");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while processing the request. Network not Saved!");
        }
    }

    public function blockedMyNetwork(Request $request): RedirectResponse
    {
        try {
            $user_id = Auth::guard('Authorized')->user()->id;
            $business_type = Auth::guard('Authorized')->user()->usr_type;

            DB::beginTransaction();

            $MyNetwork_check = MyNetwork::where('CMP_ID', $request->CMP_ID)->where('Business_Type', $business_type)->where('user_id', $user_id)->first();
            if (is_null($MyNetwork_check) && $request->CMP_ID !== $user_id) {
                $MyNetwork = new MyNetwork();
                $MyNetwork->My_Network = $request->CMP_Find;
                $MyNetwork->CMP_ID = $request->CMP_ID;
                $MyNetwork->status = 1;
                $MyNetwork->Business_Type = $business_type;
                $MyNetwork->user_id = $user_id;

                if ($MyNetwork->save()) {
                    DB::commit();
                    return redirect()->route('User.Profile')->with('Success!', "Network Blocked.");
                }

                DB::rollBack();
                return back()->with('Error!', "404 Bad Request. Network not Blocked!");
            }

            DB::rollBack();
            return back()->with('Error!', "This Network is Already in Your Blocked List!");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while processing the request. Network not Blocked!");
        }
    }

    public function updateMyNetwork(Request $request): RedirectResponse
    {
        try {
            $user_id = Auth::guard('Authorized')->user()->id;
            $business_type = Auth::guard('Authorized')->user()->usr_type;

            DB::beginTransaction();

            $MyNetwork = MyNetwork::where('id', $request->id)->where('Business_Type', $business_type)->where('user_id', $user_id)->first();
            $MyNetwork->status === 1 ? $MyNetwork->status = 0 : $MyNetwork->status = 1;
            if ($MyNetwork->update()) {
                DB::commit();
                return redirect()->route('User.Profile')->with('Success!', "Network Updated.");
            }

            DB::rollBack();
            return back()->with('Error!', "404 Bad Request. Network not Blocked!");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while processing the request. Network not Blocked!");
        }
    }

    public function updateDocumentStatus(Request $request): RedirectResponse
    {
        try {
            $user_id = $request->user_id;
            $doc_id = $request->doc_id;
            $doc_type = $request->doc_type;

            DB::beginTransaction();

            if ($doc_type === 'IP') {
                $UserCertificates = UserCertificates::where('id', $doc_id)->where('user_id', $user_id)->first();
                $UserCertificates->Insurance_Privacy === 1 ? $UserCertificates->Insurance_Privacy = 0 : $UserCertificates->Insurance_Privacy = 1;
                if ($UserCertificates->update()) {
                    DB::commit();
                    return redirect()->route('User.Profile')->with('Success!', "Document Updated.");
                }

                DB::rollBack();
                return back()->with('Error!', "404 Bad Request. Document not Updated!");
            }

            if ($doc_type === 'W9') {
                $UserCertificates = UserCertificates::where('id', $doc_id)->where('user_id', $user_id)->first();
                $UserCertificates->W_Nine_Privacy === 1 ? $UserCertificates->W_Nine_Privacy = 0 : $UserCertificates->W_Nine_Privacy = 1;
                if ($UserCertificates->update()) {
                    DB::commit();
                    return redirect()->route('User.Profile')->with('Success!', "Document Updated.");
                }

                DB::rollBack();
                return back()->with('Error!', "404 Bad Request. Document not Updated!");
            }

            if ($doc_type === 'USDOT') {
                $UserCertificates = UserCertificates::where('id', $doc_id)->where('user_id', $user_id)->first();
                $UserCertificates->USDOT_Privacy === 1 ? $UserCertificates->USDOT_Privacy = 0 : $UserCertificates->USDOT_Privacy = 1;
                if ($UserCertificates->update()) {
                    DB::commit();
                    return redirect()->route('User.Profile')->with('Success!', "Document Updated.");
                }

                DB::rollBack();
                return back()->with('Error!', "404 Bad Request. Document not Updated!");
            }

            DB::rollBack();
            return back()->with('Error!', "404 Bad Request.");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while processing the request. Document not Updated!");
        }
    }


    public function addDisputes(Request $request)
    {
        $user_id = Auth::guard('Authorized')->user()->id;

        $AddDispute = new AddDispute();
        $AddDispute->Dispute_Comments = $request->Dispute_Comments;
        $AddDispute->Profile_ID = $request->Profile_ID;
        $AddDispute->rate_id = $request->Rate_ID;
        $AddDispute->user_id = $user_id;

        if ($AddDispute->save()) {
            $DisputesFiles = new DisputesFiles();

            $flag = false;
            $last_id = $AddDispute->id;

            foreach ($request->file('Dispute_Documents') as $key => $DisputeFile) {
                $fileName = 'Uploads/Disputes/' . $user_id . '/' . $DisputeFile->getClientOriginalName();
                $DisputeFile->move(public_path('Uploads/Disputes/' . $user_id . '/'), $fileName);

                if ($DisputeFile) {
                    $insertQuery = "INSERT INTO `disputes_files`(`Dispute_Files`, `dispute_id`, `user_id`) VALUES ('" . $fileName . "', '" . $last_id . "', '" . $user_id . "')";
                    DB::insert($insertQuery);
                    $flag = true;
                }
            }
            return redirect()->route('User.Profile')->with('Success!', "Disputes are Added.");
        }
    }

    public function viewDisputes(Request $request)
    {
        $user_id = Auth::guard('Authorized')->user()->id;

        if ($request->ajax()) {
            $data = AddDispute::with('attachments')->where('Profile_ID', $request->Profile_ID)->get();

            $output = '';
            if (count($data) > 0) {
                $output = '<table class="table table-sm table-hover table-borderless">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Document(s)</th>
                            <th class="text-center" scope="col">Comments</th>
                            <th class="text-center" scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>';
                foreach ($data as $row) {
                    $output .= '<tr>
                            <td class="text-center">';
                    foreach ($row->attachments as $row1) {
                        $output .= '<a href="' . url($row1->Dispute_Files) . '" target="_blank">View Document</a><br>';
                    }
                    $output .= '</td>
                            <td class="text-center">' . $row->Dispute_Comments . '</td>
                            <th scope="col" class="text-center">' . date('F d, Y', strtotime($row->created_at)) . '</th>
                        </tr>';
                }
                $output .= '</tbody>
                </table>';
            } else {
                $output .= 'No Disputes Found';
            }
            return $output;
        }
    }

    public function deleteContract($contract_id): RedirectResponse
    {
        try {
            $user_id = Auth::guard('Authorized')->user()->id;

            DB::beginTransaction();

            MyContract::where('id', $contract_id)
                ->where('user_id', $user_id)
                ->delete();

            DB::commit();
            return back()->with('Success!', "Contract has been Deleted.");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while processing the request. Contract not Deleted!");
        }
    }
}
