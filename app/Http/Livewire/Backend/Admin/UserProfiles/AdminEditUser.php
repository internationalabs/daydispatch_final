<?php

namespace App\Http\Livewire\Backend\Admin\UserProfiles;

use App\Models\Auth\AuthorizedAgent;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Profile\UserCertificates;
use App\Models\Profile\UserInsurrance;
use App\Services\DayDispatchServices;
use App\Services\ListingServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use App\Models\Extras\ManagedUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\DayDispatchHelper;

class AdminEditUser extends Component
{
    protected ListingServices $listingServices;
    protected DayDispatchServices $dayDispatchServices;

    public function mount(ListingServices $listingServices, DayDispatchServices $dayDispatchServices): void
    {
        $this->listingServices = $listingServices;
        $this->dayDispatchServices = $dayDispatchServices;
    }

    public function render(Request $request)
    {
        $user_id = $request->User_ID;
        $usr_type = $request->USR_TYPE;
        $All_Users = '';
        $assignUser =  AuthorizedUsers::where('usr_type', '!=', 'Dispatcher')
            ->whereDoesntHave('managedUsers')
            ->get();
        $orderCount = DayDispatchHelper::getOrderCounts($user_id, $usr_type);
        if ($usr_type === 'User') {
            $User_Info = AuthorizedUsers::with(
                [
                    "insurance",
                    "certificates",
                ])->where('id', $user_id)->firstOrFail();
            $Completed = $this->listingServices->getProfileCompleteList($user_id);

            $Agents = null;
            $Agent_Revenue = null;
            $Agent_Broker_Count = 0;
            $Agent_Carrier_Count = 0;
            $currentMonth = null;
            $overallRevenue = null;
            $All_Users = ManagedUser::with('user')->where('dispatcher_id', $user_id)->get();
        } elseif ($usr_type === 'Agent') {
            $User_Info = AuthorizedAgent::where('id', $user_id)->firstOrFail();
            $Completed = null;
            $Agent_Users = AuthorizedUsers::where('ref_code', $User_Info->ref_code);
            $Agents = $Agent_Users->get();
            $Agent_Broker_Count = $Agent_Users->where('usr_type', '<>', 'Carrier')->count();
            $Agent_Carrier_Count = $Agent_Users->where('usr_type', 'Carrier')->count();
            $Agent_Revenue = $this->dayDispatchServices->calculateAgentRevenue($user_id);

            $Revenue = $this->dayDispatchServices->getAgentRevenue($user_id);
            $currentMonth = $Revenue->currentMonth()->get();
            $overallRevenue = $Revenue->get();
        } else {
            abort(404);
        }

        return view('livewire.backend.admin.user-profiles.admin-edit-user', compact('User_Info', 'usr_type', 'Completed', 'Agents', 'Agent_Revenue', 'Agent_Broker_Count', 'Agent_Carrier_Count', 'currentMonth', 'overallRevenue', 'assignUser', 'All_Users', 'orderCount'))->layout('layouts.authorized-admin');
    }

    public function UserEmailNotificationSwitch(Request $request): string
    {
        $output = 'Ajax Call Not Received';
        if ($request->ajax()) {
            AuthorizedUsers::where('id', $request->User_ID)
                ->update([
                    'is_email_notify' => ($request->Switch == 1) ? 0 : 1
                ]);
            $output = 'Notification Switch Update';
        }
        return $output;
    }

    public function UserCustomNotificationSwitch(Request $request): string
    {
        $output = 'Ajax Call Not Received';
        if ($request->ajax()) {
            AuthorizedUsers::where('id', $request->User_ID)
                ->update([
                    'is_custom_notify' => ($request->Switch == 1) ? 0 : 1
                ]);
            $output = 'Notification Switch Update';
        }
        return $output;
    }

    public function EditUserBasicInfo(Request $request): RedirectResponse
    {
        $user_id = $request->User_ID;
        $User_Info = AuthorizedUsers::where('id', $user_id)->firstOrFail();

        $User_Info->name = $request->User_Name;
        $User_Info->Local_Phone = $request->Local_Phone;
        $User_Info->Toll_Free = $request->Toll_Free;
        $User_Info->Fax_Phone = $request->Fax_Phone;
        $User_Info->Dispatch_Phone = $request->Dispatch_Phone;
        $User_Info->Contact_Method = $request->Contact_Method;
        $User_Info->Website_Url = $request->Website_URL;
        $User_Info->Time_Zone = $request->Time_Zone;
        $User_Info->Hours_Operations = $request->Hours_Operations;
        $User_Info->number_of_login = $request->number_of_login;
        $User_Info->Profile_Update = 1;

        return $this->UpdateProfileImage($request, $user_id, $User_Info);
    }

    public function EditUserInsurance(Request $request)
    {
        $user_id = $request->User_ID;

        $User_Insurance = UserInsurrance::where('user_id', $user_id)->first();
        $User_Insurance->Expiration_Date = $request->Expiration_Date;
        $User_Insurance->Cargo_Limit = $request->Carg_Limit;
        $User_Insurance->Deductable = $request->Deductible;
        $User_Insurance->Auto_Policy_Number = $request->Policy_Number;
        $User_Insurance->Cargo_Policy_Number = $request->Cargo_Number;
        $User_Insurance->Agent_Name = $request->Agent_Name;
        $User_Insurance->Agent_Phone = $request->Agent_Phone;

        if ($User_Insurance->update()) {
            $User_Certificates = UserCertificates::where('user_id', $user_id)->first();

            if ($request->file('Insurance_Certificate') !== null) {
                $Insurance_Certificate = $request->file('Insurance_Certificate');
                $Insurance_fileName = 'Insurance_Certificate_' . $user_id . '.' . $Insurance_Certificate->extension();

                if (File::exists(public_path('Uploads/Certificates/' . $user_id . '/' . $Insurance_fileName))) {
                    File::delete(public_path('Uploads/Certificates/' . $user_id . '/' . $Insurance_fileName));
                }
                $Insurance_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $Insurance_fileName);
                $User_Certificates->Insurance_Certificate = 'Uploads/Certificates/' . $user_id . '/' . $Insurance_fileName;
            }

            if ($request->file('WNine_Certificate') !== null) {
                $WNine_Certificate = $request->file('WNine_Certificate');
                $WNine_fileName = 'W9_Certificate_' . $user_id . '.' . $WNine_Certificate->extension();

                if (File::exists(public_path('Uploads/Certificates/' . $user_id . '/' . $WNine_fileName))) {
                    File::delete(public_path('Uploads/Certificates/' . $user_id . '/' . $WNine_fileName));
                }
                $WNine_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $WNine_fileName);
                $User_Certificates->W_Nine = 'Uploads/Certificates/' . $user_id . '/' . $WNine_fileName;
            }

            if ($request->file('USDOT_Certificate') !== null) {
                $USDOT_Certificate = $request->file('USDOT_Certificate');
                $USDOT_fileName = 'USDOT_Certificate_' . $user_id . '.' . $USDOT_Certificate->extension();

                if (File::exists(public_path('Uploads/Certificates/' . $user_id . '/' . $USDOT_fileName))) {
                    File::delete(public_path('Uploads/Certificates/' . $user_id . '/' . $USDOT_fileName));
                }
                $USDOT_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $USDOT_fileName);
                $User_Certificates->USDOT_Certificate = 'Uploads/Certificates/' . $user_id . '/' . $USDOT_fileName;
            }

            if ($request->file('Business_License') !== null) {
                $BSNL_Certificate = $request->file('Business_License');
                $BSNL_fileName = 'Business_License_' . $user_id . '.' . $BSNL_Certificate->extension();

                if (File::exists(public_path('Uploads/Certificates/' . $user_id . '/' . $BSNL_fileName))) {
                    File::delete(public_path('Uploads/Certificates/' . $user_id . '/' . $BSNL_fileName));
                }
                $BSNL_Certificate->move(public_path('Uploads/Certificates/' . $user_id . '/'), $BSNL_fileName);
                $User_Certificates->BSNL_Certificate = 'Uploads/Certificates/' . $user_id . '/' . $BSNL_fileName;
            }

            if ($User_Certificates->update()) {
                return redirect()->route('Admin.View.Profile', ['User_ID' => $user_id, 'USR_TYPE' => 'User'])->with('Success!', "Your Profile has been Updated.");
            }
            return back()->with('Error!', "User Certificates Not Inserted");
        }
        return back()->with('Error!', "User Insurance Not Updated");
    }

    public function EditAgentBasicInfo(Request $request): RedirectResponse
    {
        $user_id = $request->User_ID;
        $User_Info = AuthorizedAgent::where('id', $user_id)->firstOrFail();

        $User_Info->name = $request->User_Name;
        $User_Info->Phone_Number = $request->Phone_Number;
        $User_Info->Address = $request->Address;

        return $this->UpdateProfileImage($request, $user_id, $User_Info);
    }

    /**
     * @param Request $request
     * @param mixed $user_id
     * @param $User_Info
     * @return RedirectResponse
     */
    public function UpdateProfileImage(Request $request, mixed $user_id, $User_Info): RedirectResponse
    {
        if ($request->file('Profile_Image') !== null) {
            $ProfileImage = $request->file('Profile_Image');
            $imageName = 'Profile_Image_' . $user_id . '.' . $ProfileImage->extension();

            if (File::exists(public_path('Uploads/' . $request->USR_TYPE . '/Profile/' . $user_id . '/' . $imageName))) {
                File::delete(public_path('Uploads/' . $request->USR_TYPE . '/Profile/' . $user_id . '/' . $imageName));
            }
            $ProfileImage->move(public_path('Uploads/' . $request->USR_TYPE . '/Profile/' . $user_id . '/'), $imageName);
            $User_Info->profile_photo_path = 'Uploads/' . $request->USR_TYPE . '/Profile/' . $user_id . '/' . $imageName;
        }

        if ($User_Info->update()) {
            return redirect()->route('Admin.View.Profile', ['User_ID' => $user_id, 'USR_TYPE' => $request->USR_TYPE])->with('Success!', "Your Profile has been Updated.");
        }
        return back()->with('Error!', "User Profile Not Update");
    }

    public function EditUserAccess(Request $request): RedirectResponse
    {
        $user_id = $request->User_ID;
        $User = AuthorizedUsers::find($user_id);

        // if ($request->sidebar_access <> null) {
        //     $User->sidebar_access = implode(",", $request->sidebar_access);
        // }
        if ($request->has('sidebar_access'))
        {
            if ($request->sidebar_access !== null) {
                $User->sidebar_access = implode(",", $request->sidebar_access);
            } else {
                $User->sidebar_access = null;
            }
        }
        else {
            $User->sidebar_access = null;
        }
        $User->save();

        // dd($User->toArray());

        return redirect()->route('Admin.View.Profile', ['User_ID' => $user_id, 'USR_TYPE' => $request->USR_TYPE])->with('Success!', "Access Updated.");
    }

    public function EditUserOther(Request $request): RedirectResponse
    {
        $user_id = $request->User_ID;
        $User = AuthorizedUsers::find($user_id);

        // if ($request->other_access <> null) {
        //     $User->other_access = implode(",", $request->other_access);
        // }
        if ($request->has('other_access'))
        {
            if ($request->other_access !== null) {
                $User->other_access = implode(",", $request->other_access);
            } else {
                $User->other_access = null;
            }
        }
        else {
            $User->other_access = null;
        }
        $User->save();

        return redirect()->route('Admin.View.Profile', ['User_ID' => $user_id, 'USR_TYPE' => $request->USR_TYPE])->with('Success!', "Access Updated.");
    }
}
