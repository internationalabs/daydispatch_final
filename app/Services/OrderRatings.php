<?php

namespace App\Services;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Profile\MyRating;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class OrderRatings
{
    private function getAuthUserInfo(): ?Authenticatable
    {
        return Auth::guard('Authorized')->user();
    }

    // public function getUserRating()
    // {
    //     $auth_user = $this->getAuthUserInfo();
    //     return AuthorizedUsers::withCount(
    //         [
    //             'all_listing'
    //         ]
    //     )->where('id', $auth_user->id)
    //         ->withAvg('ratings', 'Timeliness')
    //         ->withAvg('ratings', 'Communication')
    //         ->withAvg('ratings', 'Documentation')
    //         ->first();
    // }

    public function getUserRating($user_id = null)
    {
        // Agar user_id null ho to auth user ko use karo, warna provided user_id ko use karo
        $user_id = $user_id ?: $this->getAuthUserInfo()->id;

        return AuthorizedUsers::withCount(['all_listing'])
            ->where('id', $user_id)
            ->withAvg('ratings', 'Timeliness')
            ->withAvg('ratings', 'Communication')
            ->withAvg('ratings', 'Documentation')
            ->first();
    }

    // public function getUserRatingRecords($user_id = null): Collection|array
    // {
    //     // dd($user_id);
    //     $auth_user = $this->getAuthUserInfo();
    //     if ($auth_user->usr_type === 'Carrier') {
    //         return MyRating::with(
    //             [
    //                 'authorized_user' => function ($q) {
    //                     $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
    //                 },
    //                 'all_listing' => function ($q) {
    //                     $q->select('*')->where('Is_Rate', 1);
    //                 }
    //             ]
    //         )->where('CMP_ID', $auth_user->id)->whereRelation('all_listing', 'Is_Rate', '=', 1)->get();
    //     } else {
    //         return MyRating::with(
    //             [
    //                 'rated_user' => function ($q) {
    //                     $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Company_City', 'Company_State');
    //                 },
    //                 'all_listing' => function ($q) {
    //                     $q->select('*')->where('Is_Rate', 1);
    //                 }
    //             ]
    //         )->where('user_id', $auth_user->id)->whereRelation('all_listing', 'Is_Rate', '=', 1)->get();
    //     }
    // }

    public function getUserRatingRecords($user_id = null): Collection|array
    {
        // Provided user_id ko use karo agar woh null nahi hai
        $user_id = $user_id ?: $this->getAuthUserInfo()->id;

        $auth_user = $this->getAuthUserInfo();
        $query = MyRating::with(
            [
                'all_listing' => function ($q) {
                    $q->select('*')->where('Is_Rate', 1);
                }
            ]
        );

        // Check agar auth user ka type 'Carrier' hai
        if ($auth_user->usr_type === 'Carrier') {
            $query->with(
                [
                    // 'authorized_user' => function ($q) {
                    //     $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                    // },
                    'rated_user' => function ($q) {
                        // $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Company_City', 'Company_State');
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                    }
                ]
            )->where('user_id', $user_id);
            // )->where('CMP_ID', $user_id);
        } else {
            $query->with(
                [
                    // 'authorized_user' => function ($q) {
                    //     $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                    // },
                    'rated_user' => function ($q) {
                        // $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Company_City', 'Company_State');
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                    }
                ]
            )->where('user_id', $user_id);
        }

        return $query->whereRelation('all_listing', 'Is_Rate', '=', 1)->get();
    }

}
