<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing\{AllUserListing,
    ListingAdditionalInfo,
    ListingDestinationLocation,
    ListingOrignLocation,
    ListingPaymentInfo,
    ListingPickupDeliverInfo,
    ListingRoutes,
    ListingVehciles};
use App\Models\Auth\AuthorizedUsers;
use App\Models\Profile\UserCertificates;
use App\Models\Profile\UserInsurrance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
        AuthorizedUsers::create([
            'name' => 'John Abraham',
            'email' => 'PakistanStateOil@email.com',
            'password' => '$2y$10$DL405SEgql5QL0dMxDqjve.opEVA2Nv8x1Bvks1iYuMyJkgtrAAYW',
            'usr_type' => 'Broker',
            'profile_photo_path' => 'Uploads/Profile/1/Profile_Image_1.webp',
            'Company_Name' => 'Pakistan State Oil',
            'Company_USDot' => '11111111',
            'Mc_Number' => '11111111',
            'Company_State' => 'AZ',
            'Company_City' => 'Miami',
            'Contact_Phone' => fake()->phoneNumber,
            'Address' => 'Testing For Pakistan State Oil',
            'Company_Desc' => '',
            'Local_Phone' => fake()->phoneNumber,
            'Toll_Free' => fake()->phoneNumber,
            'Fax_Phone' => fake()->phoneNumber,
            'Dispatch_Phone' => fake()->phoneNumber,
            'Contact_Method' => 'Any',
            'Website_Url' => 'http://127.0.0.1:8000/Authorized/User-Profile',
            'Time_Zone' => 'Eastern Standard Time (EST)',
            'Hours_Operations' => '09:00 AM to 10:00 PM',
            'Profile_Update' => 1,
            'admin_verify' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'is_email_verified' => 1,
        ])->each(function ($user) {
            UserInsurrance::create([
                'Expiration_Date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'Cargo_Limit' => '1250',
                'Deductable' => '1200',
                'Auto_Policy_Number' => '123456789',
                'Cargo_Policy_Number' => '123456789',
                'Agent_Name' => fake()->name,
                'Agent_Phone' => fake()->phoneNumber,
                'user_id' => $user->id
            ]);
            UserCertificates::create([
                'Insurance_Certificate' => null,
                'W_Nine' => null,
                'USDOT_Certificate' => null,
                'user_id' => $user->id
            ]);
                $loc_type = random_int(0,5);
                $ZipCode = DB::table('zip_codes')
                    ->inRandomOrder()
                    ->limit(2)
                    ->get();
                $origin_ZipCode = $ZipCode[0]->city.', '.$ZipCode[0]->state.', '.$ZipCode[0]->zipcode;
                $Dest_ZipCode = $ZipCode[1]->city.', '.$ZipCode[1]->state.', '.$ZipCode[1]->zipcode;
                $From = Str::afterLast($origin_ZipCode, ', ');
                $To = Str::afterLast($Dest_ZipCode, ', ');
                $miles = twopoints_on_earth($From, $To);
                $payment = random_int(200, 10000);
                $Carrier_Pay = $payment/2;
                $Cod_Amount = ($Carrier_Pay <= 1000)? $Carrier_Pay : $Carrier_Pay/2;
                $Bal = $Carrier_Pay - $Cod_Amount;

                $Pickup = Carbon::now()->addDays(rand(1,2))->format('Y-m-d');
                $Delivery = Carbon::now()->addDays(rand(3,10))->format('Y-m-d');
                AllUserListing::create([
                    'Listing_Status' => 'Listed',
                    'Ref_ID' => random_int(100,100000),
                    'user_id' => $user->id
                ])->each(function ($list) use ($Delivery, $Pickup, $Bal, $Cod_Amount, $Carrier_Pay, $payment, $miles, $Dest_ZipCode, $origin_ZipCode, $user, $loc_type){
                    ListingOrignLocation::create(
                        match ($loc_type) {
                            0 => [
                                'Orign_Location' => 'Location',
                                'User_Name' => fake()->unique()->name,
                                'User_Email' => fake()->unique()->safeEmail,
                                'Local_Phone' => fake()->phoneNumber,
                                'Location' => fake()->randomElement(['Residence', 'Business']),
                                'order_id' => $list->id,
                                'user_id' => $user->id
                            ],
                            1 => [
                                'Orign_Location' => 'Dealership',
                                'User_Name' => fake()->unique()->name,
                                'User_Email' => fake()->unique()->safeEmail,
                                'Local_Phone' => fake()->phoneNumber,
                                'Auction_Method' => fake()->name,
                                'Auction_Phone' => fake()->phoneNumber,
                                'Stock_Number' => fake()->randomDigit(),
                                'order_id' => $list->id,
                                'user_id' => $user->id
                            ],
                            2 => [
                                'Orign_Location' => 'Auction',
                                'User_Name' => fake()->unique()->name,
                                'User_Email' => fake()->unique()->safeEmail,
                                'Local_Phone' => fake()->phoneNumber,
                                'Auction_Method' => fake()->randomElement(['COPART Auction', 'Manheim Auction', 'IAAI Auction']),
                                'Auction_Phone' => fake()->phoneNumber,
                                'Stock_Number' => fake()->randomDigit(),
                                'order_id' => $list->id,
                                'user_id' => $user->id
                            ],
                            3 => [
                                'Orign_Location' => 'Port',
                                'User_Name' => fake()->unique()->name,
                                'User_Email' => fake()->unique()->safeEmail,
                                'Local_Phone' => fake()->phoneNumber,
                                'Auction_Method' => fake()->randomElement(['Sea Port', 'Air Port']),
                                'Auction_Phone' => fake()->phoneNumber,
                                'Stock_Number' => fake()->randomDigit(),
                                'order_id' => $list->id,
                                'user_id' => $user->id
                            ],
                            default => [
                                'Orign_Location' => 'Other',
                                'User_Name' => fake()->unique()->name,
                                'User_Email' => fake()->unique()->safeEmail,
                                'Local_Phone' => fake()->phoneNumber,
                                'order_id' => $list->id,
                                'user_id' => $user->id
                            ],
                        }
                    );
                    ListingDestinationLocation::create(match ($loc_type) {
                        0 => [
                            'Destination_Location' => 'Dest_Location',
                            'Dest_User_Name' => fake()->unique()->name,
                            'Dest_User_Email' => fake()->unique()->safeEmail,
                            'Dest_Local_Phone' => fake()->phoneNumber,
                            'Dest_Location' => fake()->randomElement(['Residence', 'Business']),
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                        1 => [
                            'Destination_Location' => 'Dealership',
                            'Dest_User_Name' => fake()->unique()->name,
                            'Dest_User_Email' => fake()->unique()->safeEmail,
                            'Dest_Local_Phone' => fake()->phoneNumber,
                            'Dest_Auction_Method' => fake()->name,
                            'Dest_Auction_Phone' => fake()->phoneNumber,
                            'Dest_Stock_Number' => fake()->randomDigit(),
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                        2 => [
                            'Destination_Location' => 'Auction',
                            'Dest_User_Name' => fake()->unique()->name,
                            'Dest_User_Email' => fake()->unique()->safeEmail,
                            'Dest_Local_Phone' => fake()->phoneNumber,
                            'Dest_Auction_Method' => fake()->randomElement(['COPART Auction', 'Manheim Auction', 'IAAI Auction']),
                            'Dest_Auction_Phone' => fake()->phoneNumber,
                            'Dest_Stock_Number' => fake()->randomDigit(),
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                        3 => [
                            'Destination_Location' => 'Port',
                            'Dest_User_Name' => fake()->unique()->name,
                            'Dest_User_Email' => fake()->unique()->safeEmail,
                            'Dest_Local_Phone' => fake()->phoneNumber,
                            'Dest_Auction_Method' => fake()->randomElement(['Sea Port', 'Air Port']),
                            'Dest_Auction_Phone' => fake()->phoneNumber,
                            'Dest_Stock_Number' => fake()->randomDigit(),
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                        default => [
                            'Destination_Location' => 'Other',
                            'Dest_User_Name' => fake()->unique()->name,
                            'Dest_User_Email' => fake()->unique()->safeEmail,
                            'Dest_Local_Phone' => fake()->phoneNumber,
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                    });
                    ListingRoutes::create([
                        'Origin_Address' => fake()->address,
                        'Origin_Address_II' => fake()->streetAddress,
                        'Origin_ZipCode' => $origin_ZipCode,
                        'Destination_Address' => fake()->address,
                        'Destination_Address_II' => fake()->streetAddress,
                        'Dest_ZipCode' => $Dest_ZipCode,
                        'Miles' => $miles,
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ]);
                    ListingVehciles::create([
                        'Reg_By' => 'YMM',
                        'Vin_Number' => '',
                        'Vehcile_Year' => fake()->randomElement(['2022', '2023', '2015', '2005']),
                        'Vehcile_Make' => fake()->randomElement(['Honda', 'Toyota', 'BMW', 'Ford']),
                        'Vehcile_Model' => fake()->randomElement(['Cvic', 'Corolla', 'BMW', 'Ford']),
                        'Vehcile_Color' => fake()->randomElement(['Black', 'White', 'Blue', 'Silver']),
                        'Vehcile_Type' => fake()->randomElement(['Car', 'SUV', 'Pickup', 'Van']),
                        'Vehcile_Condition' => fake()->randomElement(['Running', 'Not Running']),
                        'Trailer_Type' => fake()->randomElement(['Open', 'Enclosed']),
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ]);
                    ListingPaymentInfo::create([
                        'Order_Booking_Price' => $payment,
                        'Price_Pay_Carrier' => (int)$Carrier_Pay,
                        'Payment_Method_Mode' => fake()->randomElement(['COD', 'Quick Pay']),
                        'COD_Amount' => $Cod_Amount,
                        'Balance_Amount' => $Bal,
                        'COD_Method_Mode' => fake()->randomElement(['Check', 'Cash / Certified Funds']),
                        'COD_Location_Amount' => fake()->randomElement(['Pickup', 'Delivery']),
                        'Bal_Method_Mode' => ($Bal != 0)? fake()->randomElement(['Cash', 'Company Check', 'Certified Funds', 'Comchek', 'TCH']) : '',
                        'BAL_Payment_Time' => ($Bal != 0)? fake()->randomElement(['Immediately', '2 Business Days']) : '',
                        'BAL_Payment_Terms' => ($Bal != 0)? fake()->randomElement(['Pickup', 'Delivery', 'Recieving a Sign of Bill of Lading']) : '',
                        'Payment_Desc' => fake()->text,
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ]);
                    ListingPickupDeliverInfo::create([
                        'Pickup_Date' => $Pickup,
                        'Pickup_Date_mode' => fake()->randomElement(['Before', 'After', 'On', 'ASAP']),
                        'Delivery_Date' => $Delivery,
                        'Delivery_Date_mode' => fake()->randomElement(['Before', 'After', 'On', 'ASAP']),
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ]);
                    ListingAdditionalInfo::create([
                        'Additional_Terms' => fake()->text,
                        'Special_Instructions' => fake()->text,
                        'Notes_Customer' => fake()->text,
                        'Vehcile_Desc' => fake()->text,
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ]);
                });
        });

//
        AuthorizedUsers::create([
            'name' => 'Alaistaire Cook',
            'email' => 'AllStateToState@email.com',
            'password' => '$2y$10$DL405SEgql5QL0dMxDqjve.opEVA2Nv8x1Bvks1iYuMyJkgtrAAYW',
            'usr_type' => 'Carrier',
            'profile_photo_path' => 'Uploads/Profile/2/Profile_Image_2.png',
            'Company_Name' => 'All State To State',
            'Company_USDot' => '11111111',
            'Mc_Number' => '11111111',
            'Company_State' => 'AZ',
            'Company_City' => 'Miami',
            'Contact_Phone' => fake()->phoneNumber,
            'Address' => 'Testing For Carrier',
            'Company_Desc' => '',
            'Local_Phone' => fake()->phoneNumber,
            'Toll_Free' => fake()->phoneNumber,
            'Fax_Phone' => fake()->phoneNumber,
            'Dispatch_Phone' => fake()->phoneNumber,
            'Contact_Method' => 'Any',
            'Website_Url' => 'http://127.0.0.1:8000/Authorized/User-Profile',
            'Time_Zone' => 'Eastern Standard Time (EST)',
            'Hours_Operations' => '09:00 AM to 10:00 PM',
            'Profile_Update' => 1,
            'admin_verify' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'is_email_verified' => 1,
        ])->each(function ($user) {
            UserInsurrance::create([
                'Expiration_Date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'Cargo_Limit' => '1250',
                'Deductable' => '1200',
                'Auto_Policy_Number' => '123456789',
                'Cargo_Policy_Number' => '123456789',
                'Agent_Name' => fake()->unique()->name,
                'Agent_Phone' => fake()->phoneNumber,
                'user_id' => $user->id
            ]);
            UserCertificates::create([
                'Insurance_Certificate' => null,
                'W_Nine' => null,
                'USDOT_Certificate' => null,
                'user_id' => $user->id
            ]);
            $loc_type = random_int(0,5);
            $ZipCode = DB::table('zip_codes')
                ->inRandomOrder()
                ->limit(2)
                ->get();
            $origin_ZipCode = $ZipCode[0]->city.', '.$ZipCode[0]->state.', '.$ZipCode[0]->zipcode;
            $Dest_ZipCode = $ZipCode[1]->city.', '.$ZipCode[1]->state.', '.$ZipCode[1]->zipcode;
            $From = Str::afterLast($origin_ZipCode, ', ');
            $To = Str::afterLast($Dest_ZipCode, ', ');
            $miles = twopoints_on_earth($From, $To);
            $payment = random_int(200, 10000);
            $Carrier_Pay = $payment/2;
            $Cod_Amount = ($Carrier_Pay <= 1000)? $Carrier_Pay : $Carrier_Pay/2;
            $Bal = $Carrier_Pay - $Cod_Amount;

            $Pickup = Carbon::now()->addDays(random_int(1,2))->format('Y-m-d');
            $Delivery = Carbon::now()->addDays(random_int(3,10))->format('Y-m-d');
            AllUserListing::create([
                'Listing_Status' => 'Listed',
                'Ref_ID' => random_int(100,100000),
                'user_id' => $user->id
            ])->each(function ($list) use ($Delivery, $Pickup, $Bal, $Cod_Amount, $Carrier_Pay, $payment, $miles, $Dest_ZipCode, $origin_ZipCode, $user, $loc_type){
                ListingOrignLocation::create(
                    match ($loc_type) {
                        0 => [
                            'Orign_Location' => 'Location',
                            'User_Name' => fake()->unique()->name,
                            'User_Email' => fake()->unique()->safeEmail,
                            'Local_Phone' => fake()->phoneNumber,
                            'Location' => fake()->randomElement(['Residence', 'Business']),
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                        1 => [
                            'Orign_Location' => 'Dealership',
                            'User_Name' => fake()->unique()->name,
                            'User_Email' => fake()->unique()->safeEmail,
                            'Local_Phone' => fake()->phoneNumber,
                            'Auction_Method' => fake()->name,
                            'Auction_Phone' => fake()->phoneNumber,
                            'Stock_Number' => fake()->randomDigit(),
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                        2 => [
                            'Orign_Location' => 'Auction',
                            'User_Name' => fake()->unique()->name,
                            'User_Email' => fake()->unique()->safeEmail,
                            'Local_Phone' => fake()->phoneNumber,
                            'Auction_Method' => fake()->randomElement(['COPART Auction', 'Manheim Auction', 'IAAI Auction']),
                            'Auction_Phone' => fake()->phoneNumber,
                            'Stock_Number' => fake()->randomDigit(),
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                        3 => [
                            'Orign_Location' => 'Port',
                            'User_Name' => fake()->unique()->name,
                            'User_Email' => fake()->unique()->safeEmail,
                            'Local_Phone' => fake()->phoneNumber,
                            'Auction_Method' => fake()->randomElement(['Sea Port', 'Air Port']),
                            'Auction_Phone' => fake()->phoneNumber,
                            'Stock_Number' => fake()->randomDigit(),
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                        default => [
                            'Orign_Location' => 'Other',
                            'User_Name' => fake()->unique()->name,
                            'User_Email' => fake()->unique()->safeEmail,
                            'Local_Phone' => fake()->phoneNumber,
                            'order_id' => $list->id,
                            'user_id' => $user->id
                        ],
                    }
                );
                ListingDestinationLocation::create(match ($loc_type) {
                    0 => [
                        'Destination_Location' => 'Dest_Location',
                        'Dest_User_Name' => fake()->unique()->name,
                        'Dest_User_Email' => fake()->unique()->safeEmail,
                        'Dest_Local_Phone' => fake()->phoneNumber,
                        'Dest_Location' => fake()->randomElement(['Residence', 'Business']),
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ],
                    1 => [
                        'Destination_Location' => 'Dealership',
                        'Dest_User_Name' => fake()->unique()->name,
                        'Dest_User_Email' => fake()->unique()->safeEmail,
                        'Dest_Local_Phone' => fake()->phoneNumber,
                        'Dest_Auction_Method' => fake()->name,
                        'Dest_Auction_Phone' => fake()->phoneNumber,
                        'Dest_Stock_Number' => fake()->randomDigit(),
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ],
                    2 => [
                        'Destination_Location' => 'Auction',
                        'Dest_User_Name' => fake()->unique()->name,
                        'Dest_User_Email' => fake()->unique()->safeEmail,
                        'Dest_Local_Phone' => fake()->phoneNumber,
                        'Dest_Auction_Method' => fake()->randomElement(['COPART Auction', 'Manheim Auction', 'IAAI Auction']),
                        'Dest_Auction_Phone' => fake()->phoneNumber,
                        'Dest_Stock_Number' => fake()->randomDigit(),
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ],
                    3 => [
                        'Destination_Location' => 'Port',
                        'Dest_User_Name' => fake()->unique()->name,
                        'Dest_User_Email' => fake()->unique()->safeEmail,
                        'Dest_Local_Phone' => fake()->phoneNumber,
                        'Dest_Auction_Method' => fake()->randomElement(['Sea Port', 'Air Port']),
                        'Dest_Auction_Phone' => fake()->phoneNumber,
                        'Dest_Stock_Number' => fake()->randomDigit(),
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ],
                    default => [
                        'Destination_Location' => 'Other',
                        'Dest_User_Name' => fake()->unique()->name,
                        'Dest_User_Email' => fake()->unique()->safeEmail,
                        'Dest_Local_Phone' => fake()->phoneNumber,
                        'order_id' => $list->id,
                        'user_id' => $user->id
                    ],
                });
                ListingRoutes::create([
                    'Origin_Address' => fake()->address,
                    'Origin_Address_II' => fake()->streetAddress,
                    'Origin_ZipCode' => $origin_ZipCode,
                    'Destination_Address' => fake()->address,
                    'Destination_Address_II' => fake()->streetAddress,
                    'Dest_ZipCode' => $Dest_ZipCode,
                    'Miles' => $miles,
                    'order_id' => $list->id,
                    'user_id' => $user->id
                ]);
                ListingVehciles::create([
                    'Reg_By' => 'YMM',
                    'Vin_Number' => '',
                    'Vehcile_Year' => fake()->randomElement(['2022', '2023', '2015', '2005']),
                    'Vehcile_Make' => fake()->randomElement(['Honda', 'Toyota', 'BMW', 'Ford']),
                    'Vehcile_Model' => fake()->randomElement(['Cvic', 'Corolla', 'BMW', 'Ford']),
                    'Vehcile_Color' => fake()->randomElement(['Black', 'White', 'Blue', 'Silver']),
                    'Vehcile_Type' => fake()->randomElement(['Car', 'SUV', 'Pickup', 'Van']),
                    'Vehcile_Condition' => fake()->randomElement(['Running', 'Not Running']),
                    'Trailer_Type' => fake()->randomElement(['Open', 'Enclosed']),
                    'order_id' => $list->id,
                    'user_id' => $user->id
                ]);
                ListingPaymentInfo::create([
                    'Order_Booking_Price' => intval($payment),
                    'Price_Pay_Carrier' => intval($Carrier_Pay),
                    'Payment_Method_Mode' => fake()->randomElement(['COD', 'Quick Pay']),
                    'COD_Amount' => $Cod_Amount,
                    'Balance_Amount' => $Bal,
                    'COD_Method_Mode' => fake()->randomElement(['Check', 'Cash / Certified Funds']),
                    'COD_Location_Amount' => fake()->randomElement(['Pickup', 'Delivery']),
                    'Bal_Method_Mode' => ($Bal != 0)? fake()->randomElement(['Cash', 'Company Check', 'Certified Funds', 'Comchek', 'TCH']) : '',
                    'BAL_Payment_Time' => ($Bal != 0)? fake()->randomElement(['Immediately', '2 Business Days']) : '',
                    'BAL_Payment_Terms' => ($Bal != 0)? fake()->randomElement(['Pickup', 'Delivery', 'Recieving a Sign of Bill of Lading']) : '',
                    'Payment_Desc' => fake()->text,
                    'order_id' => $list->id,
                    'user_id' => $user->id
                ]);
                ListingPickupDeliverInfo::create([
                    'Pickup_Date' => $Pickup,
                    'Pickup_Date_mode' => fake()->randomElement(['Before', 'After', 'On', 'ASAP']),
                    'Delivery_Date' => $Delivery,
                    'Delivery_Date_mode' => fake()->randomElement(['Before', 'After', 'On', 'ASAP']),
                    'order_id' => $list->id,
                    'user_id' => $user->id
                ]);
                ListingAdditionalInfo::create([
                    'Additional_Terms' => fake()->text,
                    'Special_Instructions' => fake()->text,
                    'Notes_Customer' => fake()->text,
                    'Vehcile_Desc' => fake()->text,
                    'order_id' => $list->id,
                    'user_id' => $user->id
                ]);
            });
        });

//        AllUserListing::factory(5)->has(
//            ListingDestinationLocation::factory()->count(5),
//            ListingOrignLocation::factory()->count(5),
//            ListingRoutes::factory()->count(5),
//            ListingVehciles::factory()->count(5),
//            ListingPaymentInfo::factory()->count(5),
//            ListingPickupDeliverInfo::factory()->count(5),
//            ListingAdditionalInfo::factory()->count(5)
//        )->create();
    }
}
