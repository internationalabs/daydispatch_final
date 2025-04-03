<?php

namespace App\Http\Livewire\Backend\Filters;

use App\Models\Listing\AllUserListing;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Support\Facades\Http;
use App\Models\Profile\MyRating;
use App\Models\Filter;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Helpers\DayDispatchHelper;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Listing\WatchList;
use App\Models\Broker\RequestCarrier;
use App\Models\Carrier\RequestBroker;
use App\Services\OrderRatings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ListingFilter extends Component
{
    public function render(Request $request)
    {
        // dd($request->toArray());
        $auth_user = Auth::guard('Authorized')->user();
        $SaveFilter = Filter::where('user_id', $auth_user->id)->get();
        $Search_vehicleType = null;
        $watchlist = WatchList::where('user_id', $auth_user->id)->get();

        $originCity = $request->input('Origin_City') ?? null;
        $destCity = $request->input('Dest_City') ?? null;
        $Origin_State = $request->input('Origin_State') ?? null;
        $Destination_State = $request->input('Destination_State') ?? null;

        $savedFilter = Filter::where('name', $request->filterName)
            ->where('user_id', $auth_user->id)
            ->first();

        if ($savedFilter) {
            $savedFilterId = $savedFilter->id;
        } else {
            $savedFilterId = null;
        }

        //savedFilter
        if ($savedFilter) {
            $originAddress = $savedFilter->Origin_Address;
            $originCity = $savedFilter->Origin_City;
            $destCity = $savedFilter->Dest_City;
            $Origin_State = $savedFilter->Origin_State;
            // dd($Origin_State);
            $Destination_State = $savedFilter->Destination_State;
            $Origin_ZipCode_single = $savedFilter->Origin_ZipCode_single;
            $Destination_ZipCode_single = $savedFilter->Destination_ZipCode_single;
            $postedHours = (int) $savedFilter->Posted_Hrs;
            $Ship_Ready = (int) $savedFilter->Ship_Ready;
            $Prop_Date = $savedFilter->Prop_Date;
            $shipperPrefer = $savedFilter->Shipper_Preferences;
            $vehicleCondition = $savedFilter->Vehcile_Condition;
            $trailerType = $savedFilter->Trailer_Type;
            $originRadius = $savedFilter->Origin_Radius;
            $destinationRadius = $savedFilter->Destination_Radius;
            $compActive = $savedFilter->compActive;
            $equipmentType = $savedFilter->Equipment_Type;
            $originZipCode = $savedFilter->Origin_ZipCode;
            $destinationZipCode = $savedFilter->Destination_ZipCode;
            $MinTotalPay = $savedFilter->Min_Total_Pay;
            $MinRatePay = $savedFilter->Min_Rate_Pay;
            $PaymentType = $savedFilter->Payment_Type;
            $MinVehicle = $savedFilter->Min_Vehicle;
            $MaxVehicle = $savedFilter->Max_Vehicle;
            $Shipment_Prefrences = $savedFilter->Shipment_Prefrences;
            $Trailer_Specification = $savedFilter->Trailer_Specification;
            $Min_Length = $savedFilter->Min_Length;
            $Max_Length = $savedFilter->Max_Length;
            $Min_Width = $savedFilter->Min_Width;
            $Max_Width = $savedFilter->Max_Width;
            $Min_Height = $savedFilter->Min_Height;
            $Max_Height = $savedFilter->Max_Height;
            $Min_Weight = $savedFilter->Min_Weight;
            $Max_Weight = $savedFilter->Max_Weight;
            $Fright_Equipment_Type = $savedFilter->Fright_Equipment_Type;
            $Fright_Shipment_Prefrences = $savedFilter->Fright_Shipment_Prefrences;
            $Fright_Trailer_Specification = $savedFilter->Fright_Trailer_Specification;
            $Freight_Class = $savedFilter->Freight_Class;
            $Min_Freight_Weight = $savedFilter->Min_Freight_Weight;
            $Max_Freight_Weight = $savedFilter->Max_Freight_Weight;
            $state = $savedFilter->state;
            $user_id = $savedFilter->user_id;
            $Rating = $savedFilter->Rating;
            $Sorting = $savedFilter->sorting;
            $vehicleType = $savedFilter->Vehcile_Type;

            preg_match('/\(([^,]+),\s*([^)]+)\)/', $compActive, $matches);
            $companyCity = $matches[1] ?? null;
            $companyState = $matches[2] ?? null;

            $companyName = explode('(', $compActive)[0] ?? null;
            $companyName = trim($companyName);

            $selectedRegions = $savedFilter->option;

            $statesMap = [
                "NorthEast" => ['CT', 'DE', 'MA', 'ME', 'NH', 'NJ', 'NY', 'PA', 'RI', 'VT'],
                "SouthEast" => ['AL', 'DC', 'FL', 'GA', 'KY', 'MD', 'NC', 'SC', 'TN', 'VA', 'WV'],
                "MiddleWest Plains" => ['IA', 'IL', 'IN', 'KS', 'MI', 'MN', 'MO', 'ND', 'NE', 'OH', 'SD', 'WI'],
                "South" => ['AR', 'LA', 'MS', 'OK', 'TX'],
                "NorthWest" => ['ID', 'MT', 'OR', 'WA', 'WY'],
                "SouthWest" => ['AZ', 'CA', 'CO', 'NM', 'NV', 'UT'],
                "Pacific" => ['AK', 'HI']
            ];

            $allStates = [];
            if (is_array($selectedRegions)) {
                foreach ($selectedRegions as $region) {
                    $allStates = array_merge($allStates, $statesMap[$region] ?? []);
                }
            }

            $allStates = array_unique($allStates);

            $destinationAddresses = $savedFilter->Destination_Address;
            $statesMap = [
                "NorthEast" => ['CT', 'DE', 'MA', 'ME', 'NH', 'NJ', 'NY', 'PA', 'RI', 'VT'],
                "SouthEast" => ['AL', 'DC', 'FL', 'GA', 'KY', 'MD', 'NC', 'SC', 'TN', 'VA', 'WV'],
                "MiddleWest Plains" => ['IA', 'IL', 'IN', 'KS', 'MI', 'MN', 'MO', 'ND', 'NE', 'OH', 'SD', 'WI'],
                "South" => ['AR', 'LA', 'MS', 'OK', 'TX'],
                "NorthWest" => ['ID', 'MT', 'OR', 'WA', 'WY'],
                "SouthWest" => ['AZ', 'CA', 'CO', 'NM', 'NV', 'UT'],
                "Pacific" => ['AK', 'HI']
            ];

            $destinationStates = [];
            if (is_array($destinationAddresses)) {
                foreach ($destinationAddresses as $address) {
                    $destinationStates = array_merge($destinationStates, $statesMap[$address] ?? []);
                }
            }

            $destinationStates = array_unique($destinationStates);

            $originLatLng = $this->getLatitudeFromZipcode($originZipCode);
            $originLatitude = $originLatLng['latitude'] ?? null;
            $originLongitude = $originLatLng['longitude'] ?? null;

            $destLatLng = $this->getLatitudeFromZipcode($destinationZipCode);
            $destinationLatitude = $destLatLng['latitude'] ?? null;
            $destinationLongitude = $destLatLng['longitude'] ?? null;

            if ($shipperPrefer == 1) {
                $Lisiting = AllUserListing::query()
                    ->active();
            } else {
                $Lisiting = AllUserListing::query()
                    ->whereHas('My_Network', fn($q) => $q->where('status', '!=', 1))
                    ->active();
            }

            // for user ratings
            $ratings = [];
            $userIds = [];
            $avg_ratings = [];
            $user_ratings = [];


            if (!empty($request->Rating) && is_array($request->Rating) && !empty($request->Rating[0])) {
                $users = AuthorizedUsers::all();
                foreach ($users as $user) {
                    $userRatings = $this->getUserRating($user->id);
                    $ratingsData = $userRatings['ratings'];
                    $ratingsCount = $userRatings['count'];

                    $avg_rating = null;
                    if ($ratingsData && $ratingsCount > 0) {
                        $avg_rating = array_sum([
                                $ratingsData->ratings_avg_timeliness ?? 0,
                                $ratingsData->ratings_avg_communication ?? 0,
                                $ratingsData->ratings_avg_documentation ?? 0,
                            ]) / 3;
                    }

                    if ($avg_rating !== null) {
                        $user_ratings[$user->id] = (float) $avg_rating;
                    }

                    $ratings[] = $ratingsData;
                    $userIds[] = $user->id;
                    $avg_ratings[] = $avg_rating;
                }

                $userIds = [];

                foreach ($request->Rating as $value) {
                    $filterRating = (float) $value;

                    $filtered_user_ratings = array_filter($user_ratings, function ($rating) use ($filterRating) {
                        $roundedRating = floor($rating);
                        $roundedFilterRating = floor($filterRating);
                        return $roundedRating == $roundedFilterRating;
                    });

                    $userIds = array_merge($userIds, array_keys($filtered_user_ratings));
                }

                $userIds = array_unique($userIds);

                $Lisiting = $Lisiting->whereIn('user_id', $userIds);
            }

            $Lisiting = $Lisiting->when(!empty($companyName) && !empty($companyCity) && !empty($companyState), function ($query) use ($companyName, $companyCity, $companyState) {
                $query->whereHas('authorized_user', function ($subQuery) use ($companyName, $companyCity, $companyState) {
                    $subQuery
                        ->where('Company_Name', 'LIKE', "%$companyName%")
                        ->where('Company_City', 'LIKE', "%$companyCity%")
                        ->where('Company_State', 'LIKE', "%$companyState%");
                });
            })
                ->when(!empty($Sorting), function ($query) use ($Sorting) {
                    $query->whereHas('authorized_user', function ($subQuery) use ($Sorting) {
                        $subQuery->orderBy('id');
                    });
                })->with([
                    'authorized_user' => function ($query) use ($Sorting) {
                        $query->orderBy('id');
                    }
                ])
                ->when(!empty($originAddress), function ($query) use ($originAddress) {
                    $query->whereHas('routes', function ($subQuery) use ($originAddress) {
                        $subQuery->where('Origin_ZipCode', $originAddress);
                    });
                })
                ->when(!empty($Origin_State), function ($query) use ($Origin_State) {
                    $Origin_State = strtoupper($Origin_State);
                    $query->whereHas('routes', function ($subQuery) use ($Origin_State) {
                        $subQuery->whereRaw("BINARY `Origin_ZipCode` LIKE ?", ["%$Origin_State%"]);
                    });
                })
                ->when(!empty($Origin_ZipCode_single), function ($query) use ($Origin_ZipCode_single) {
                    $query->whereHas('routes', function ($subQuery) use ($Origin_ZipCode_single) {
                        // $subQuery->whereRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(Origin_ZipCode, ',', -1)) = ?", [$Origin_ZipCode_single]);
                        $subQuery->where('Origin_ZipCode', 'LIKE', "%$Origin_ZipCode_single%");
                    });
                })
                ->when(!empty($Destination_ZipCode_single), function ($query) use ($Destination_ZipCode_single) {
                    $query->whereHas('routes', function ($subQuery) use ($Destination_ZipCode_single) {
                        $subQuery->whereRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(Dest_ZipCode, ',', -1)) = ?", [$Destination_ZipCode_single]);
                    });
                })
                ->when(!empty($Destination_ZipCode_single), function ($query) use ($Destination_ZipCode_single) {
                    $query->whereHas('routes', function ($subQuery) use ($Destination_ZipCode_single) {
                        $subQuery->where('Dest_ZipCode', 'LIKE', "%$Destination_ZipCode_single");
                    });
                })
                ->when(!empty($Destination_State), function ($query) use ($Destination_State) {
                    $Destination_State = strtoupper($Destination_State);
                    $query->whereHas('routes', function ($subQuery) use ($Destination_State) {
                        $subQuery->whereRaw("BINARY `Dest_ZipCode` LIKE ?", ["%$Destination_State%"]);
                    });
                })
                ->when(!empty($originCity), function ($query) use ($originCity) {
                    // Split the cities by comma and trim any whitespace
                    $cities = array_map('trim', explode(',', $originCity));

                    $query->whereHas('routes', function ($subQuery) use ($cities) {
                        $subQuery->where(function ($q) use ($cities) {
                            foreach ($cities as $city) {
                                $q->orWhere('Origin_ZipCode', 'LIKE', "$city%");
                            }
                        });
                    });
                })
                ->when(!empty($destCity), function ($query) use ($destCity) {
                    $query->whereHas('routes', function ($subQuery) use ($destCity) {
                        $subQuery->where('Dest_ZipCode', 'LIKE', "$destCity%");
                    });
                })
                ->when(!empty($MinTotalPay), function ($query) use ($MinTotalPay) {
                    $query->whereHas('paymentinfo', function ($subQuery) use ($MinTotalPay) {
                        $subQuery->where('Price_Pay_Carrier', '>=', $MinTotalPay);
                    });
                })
                ->when(!empty($MinRatePay), function ($query) use ($MinRatePay) {
                    $query->whereHas('paymentinfo', function ($subQuery) use ($MinRatePay) {
                        $subQuery->whereRaw('(Price_Pay_Carrier / (select Miles from listing_routes where listing_routes.order_id = listing_payment_infos.order_id limit 1)) >= ?', [floatval($MinRatePay)]);
                    });
                })
                ->when(!empty($equipmentType), function ($query) use ($equipmentType) {
                    $query->whereHas('heavy_equipments', function ($subQuery) use ($equipmentType) {
                        $subQuery->where(function ($query) use ($equipmentType) {
                            foreach ($equipmentType as $type) {
                                $query->orWhere('Trailer_Type', '=', $type);
                            }
                        });
                    });
                })
                ->when(!empty($Min_Length) && !empty($Max_Length), function ($query) use ($Min_Length, $Max_Length) {
                    $query->whereHas('heavy_equipments', function ($subQuery) use ($Min_Length, $Max_Length) {
                        $subQuery->whereBetween('Equip_Length', [$Min_Length, $Max_Length]);
                    });
                })
                ->when(!empty($Min_Width) && !empty($Max_Width), function ($query) use ($Min_Width, $Max_Width) {
                    $query->whereHas('heavy_equipments', function ($subQuery) use ($Min_Width, $Max_Width) {
                        $subQuery->whereBetween('Equip_Width', [$Min_Width, $Max_Width]);
                    });
                })
                ->when(!empty($Min_Height) && !empty($Max_Height), function ($query) use ($Min_Height, $Max_Height) {
                    $query->whereHas('heavy_equipments', function ($subQuery) use ($Min_Height, $Max_Height) {
                        $subQuery->whereBetween('Equip_Height', [$Min_Height, $Max_Height]);
                    });
                })
                ->when(!empty($Min_Weight) && !empty($Max_Weight), function ($query) use ($Min_Weight, $Max_Weight) {
                    $query->whereHas('heavy_equipments', function ($subQuery) use ($Min_Weight, $Max_Weight) {
                        $subQuery->whereBetween('Equip_Weight', [$Min_Weight, $Max_Weight]);
                    });
                })
                ->when(!empty($Shipment_Prefrences), function ($query) use ($Shipment_Prefrences) {
                    $query->whereHas('heavy_equipments', function ($subQuery) use ($Shipment_Prefrences) {
                        $subQuery->where(function ($query) use ($Shipment_Prefrences) {
                            foreach ($Shipment_Prefrences as $preference) {
                                $query->orWhere('Shipment_Preferences', '=', $preference);
                            }
                        });
                    });
                })
                ->when(!empty($Trailer_Specification), function ($query) use ($Trailer_Specification) {
                    $query->whereHas('heavy_equipments', function ($subQuery) use ($Trailer_Specification) {
                        $subQuery->where(function ($query) use ($Trailer_Specification) {
                            foreach ($Trailer_Specification as $specification) {
                                $query->orWhere('Trailer_Specification', '=', $specification);
                            }
                        });
                    });
                })
                ->when(!empty($destinationStates), function ($query) use ($destinationStates) {
                    $query->whereHas('routes', function ($subQuery) use ($destinationStates) {
                        $subQuery->where(function ($query) use ($destinationStates) {
                            foreach ($destinationStates as $dest_state) {
                                $query->orWhereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(Dest_ZipCode, ',', 2), ',', -1) LIKE ?", ["%$dest_state%"]);
                            }
                        });
                    });
                })
                ->when(!empty($allStates), function ($query) use ($allStates) {
                    $query->whereHas('routes', function ($subQuery) use ($allStates) {
                        $subQuery->where(function ($query) use ($allStates) {
                            foreach ($allStates as $state) {
                                $query->orWhereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(Origin_ZipCode, ',', 2), ',', -1) LIKE ?", ["%$state%"]);
                            }
                        });
                    });
                })
                ->when(!empty($state), function ($query) use ($state) {
                    $query->whereHas('routes', function ($subQuery) use ($state) {
                        $subQuery->whereRaw('SUBSTRING_INDEX(SUBSTRING_INDEX(Origin_ZipCode, ", ", -2), ",", 1) = ?', [$state]);
                    });
                })
                ->when(!empty($PaymentType), function ($query) use ($PaymentType) {
                    $query->whereHas('paymentinfo', function ($subQuery) use ($PaymentType) {
                        $subQuery->whereIn('Payment_Method_Mode', $PaymentType);
                    });
                })
                ->when(!empty($postedHours), function ($query) use ($postedHours) {
                    $query->where('created_at', '>=', Carbon::now()->subHours($postedHours));
                })
                ->when(!empty($Ship_Ready), function ($query) use ($Ship_Ready) {
                    $endDate = now()->addDays($Ship_Ready);

                    $query->whereHas('pickup_delivery_info', function ($subQuery) use ($endDate) {
                        $subQuery->whereBetween('Pickup_Date', [now()->startOfDay(), $endDate]);
                    });
                })
                ->when(!empty($Prop_Date), function ($query) use ($Prop_Date, $Lisiting) {
                    $query->whereHas('pickup_delivery_info', function ($subQuery) use ($Prop_Date) {
                        $subQuery->whereDate('Delivery_Date', $Prop_Date);
                    });
                })
                ->when(!empty($vehicleType), function ($query) use ($vehicleType) {
                    if (is_array($vehicleType)) {
                        $query->whereHas('vehicles', function ($subQuery) use ($vehicleType) {
                            $subQuery->where(function ($q) use ($vehicleType) {
                                foreach ($vehicleType as $type) {
                                    $q->orWhere('Vehcile_Type', 'LIKE', "%$type%");
                                }
                            });
                        });
                    }
                })
                ->when(!empty($vehicleCondition), function ($query) use ($vehicleCondition) {
                    $query->whereHas('vehicles', function ($subQuery) use ($vehicleCondition) {
                        $subQuery->whereIn('Vehcile_Condition', $vehicleCondition);
                    });
                })
                ->when(!empty($trailerType), function ($query) use ($trailerType) {
                    $query->whereHas('vehicles', function ($subQuery) use ($trailerType) {
                        $subQuery->where(function ($query) use ($trailerType) {
                            foreach ($trailerType as $type) {
                                $query->orWhere('Trailer_Type', '=', $type);
                            }
                        });
                    });
                })
                ->when(!empty($Fright_Equipment_Type), function ($query) use ($Fright_Equipment_Type) {
                    $query->whereHas('dry_vans', function ($subQuery) use ($Fright_Equipment_Type) {
                        $subQuery->where(function ($query) use ($Fright_Equipment_Type) {
                            foreach ($Fright_Equipment_Type as $type) {
                                $query->orWhere('Trailer_Type_Dry', '=', $type);
                            }
                        });
                    });
                })
                ->when(!empty($Fright_Shipment_Prefrences), function ($query) use ($Fright_Shipment_Prefrences) {
                    $query->whereHas('dry_vans', function ($subQuery) use ($Fright_Shipment_Prefrences) {
                        $subQuery->where(function ($query) use ($Fright_Shipment_Prefrences) {
                            foreach ($Fright_Shipment_Prefrences as $preference) {
                                $query->orWhere('Shipment_Preferences', '=', $preference);
                            }
                        });
                    });
                })
                ->when(!empty($Fright_Trailer_Specification), function ($query) use ($Fright_Trailer_Specification) {
                    $query->whereHas('dry_vans', function ($subQuery) use ($Fright_Trailer_Specification) {
                        $subQuery->where(function ($query) use ($Fright_Trailer_Specification) {
                            foreach ($Fright_Trailer_Specification as $specification) {
                                $query->orWhere('Trailer_Specification_Dry', '=', $specification);
                            }
                        });
                    });
                })
                ->when(!empty($Freight_Class), function ($query) use ($Freight_Class) {
                    $query->whereHas('dry_vans', function ($subQuery) use ($Freight_Class) {
                        $subQuery->where(function ($query) use ($Freight_Class) {
                            foreach ($Freight_Class as $class) {
                                $query->orWhere('Freight_Class', '=', $class);
                            }
                        });
                    });
                })
                ->when(!empty($Min_Freight_Weight) && !empty($Max_Freight_Weight), function ($query) use ($Min_Freight_Weight, $Max_Freight_Weight) {
                    $query->whereHas('dry_vans', function ($subQuery) use ($Min_Freight_Weight, $Max_Freight_Weight) {
                        $subQuery->whereBetween('Freight_Weight', [$Min_Freight_Weight, $Max_Freight_Weight]);
                    });
                })
                ->when(!empty($MinVehicle), function ($query) use ($MinVehicle) {
                    $query->where(function ($query) use ($MinVehicle) {
                        // Filter for vehicles with minimum count
                        $query->orWhereHas('vehicles', function ($subQuery) use ($MinVehicle) {
                            $subQuery->selectRaw('count(*) as vehicle_count')
                                ->groupBy('order_id')
                                ->havingRaw('count(*) >= ?', [$MinVehicle]);
                        });

                        // Filter for heavy equipment with minimum count
                        $query->orWhereHas('heavy_equipments', function ($subQuery) use ($MinVehicle) {
                            $subQuery->selectRaw('count(*) as equipment_count')
                                ->groupBy('order_id')
                                ->havingRaw('count(*) >= ?', [$MinVehicle]);
                        });

                        // Filter for dry vans with minimum count
                        $query->orWhereHas('dry_vans', function ($subQuery) use ($MinVehicle) {
                            $subQuery->selectRaw('count(*) as dryvan_count')
                                ->groupBy('order_id')
                                ->havingRaw('count(*) >= ?', [$MinVehicle]);
                        });
                    });
                })
                ->when(!empty($MaxVehicle), function ($query) use ($MaxVehicle) {
                    $query->where(function ($query) use ($MaxVehicle) {
                        // Filter for vehicles with maximum count
                        $query->orWhereHas('vehicles', function ($subQuery) use ($MaxVehicle) {
                            $subQuery->selectRaw('count(*) as vehicle_count')
                                ->groupBy('order_id')
                                ->havingRaw('count(*) <= ?', [$MaxVehicle]);
                        });

                        // Filter for heavy equipment with maximum count
                        $query->orWhereHas('heavy_equipments', function ($subQuery) use ($MaxVehicle) {
                            $subQuery->selectRaw('count(*) as equipment_count')
                                ->groupBy('order_id')
                                ->havingRaw('count(*) <= ?', [$MaxVehicle]);
                        });

                        // Filter for dry vans with maximum count
                        $query->orWhereHas('dry_vans', function ($subQuery) use ($MaxVehicle) {
                            $subQuery->selectRaw('count(*) as dryvan_count')
                                ->groupBy('order_id')
                                ->havingRaw('count(*) <= ?', [$MaxVehicle]);
                        });
                    });
                })
                ->with([
                    'routes',
                    'additional_info' => function ($q) {
                        $q->select('id', 'order_id', 'Additional_Terms');
                    },
                    'vehicles',
                    'heavy_equipments',
                    'dry_vans',
                    'dry_vans_services',
                    'pickup_delivery_info',
                    'attachments',
                    'authorized_user',
                ])
                ->notExpire()->orderBy('id', 'DESC')->where('Private_Listing', 0)
                ->paginate($request->input('per_page', 10));
        } else {
            $Lisiting = AllUserListing::where('Listing_Status', 'Listed')->where('Private_Listing', 0)
                ->active()
                // ->whereHas('My_Network', fn($q) => $q->where('status', '!=', 1))
                ->carrierlisting()
                ->notExpire()
                ->orderBy('id', 'DESC')
                ->when(!empty($Origin_State), function ($query) use ($Origin_State) {
                    $states = array_map('trim', $Origin_State);  // Trim and prepare the states
                    $query->whereHas('routes', function ($q) use ($states) {
                        foreach ($states as $state) {
                            $state = strtoupper($state);
                            $q->whereRaw("BINARY `Origin_ZipCode` LIKE ?", ["%$state%"]);
                        }
                    });
                })
                ->when(!empty($Destination_State), function ($query) use ($Destination_State) {
                    $states = array_map('trim', $Destination_State);
                    $query->whereHas('routes', function ($q) use ($states) {
                        foreach ($states as $state) {
                            $state = strtoupper($state);
                            $q->whereRaw("BINARY `Dest_ZipCode` LIKE ?", ["%$state%"]);
                        }
                    });
                })
                ->when(!empty($originCity), function ($query) use ($originCity) {
                    $cities = array_map('trim', $originCity);
                    $query->whereHas('routes', function ($q) use ($cities) {
                        foreach ($cities as $city) {
                            $q->where('Origin_ZipCode', 'LIKE', "$city%");
                        }
                    });
                })
                ->when(!empty($destCity), function ($query) use ($destCity) {
                    $cities = array_map('trim', $destCity);
                    $query->whereHas('routes', function ($q) use ($cities) {
                        foreach ($cities as $city) {
                            $q->where('Dest_ZipCode', 'LIKE', "$city%");
                        }
                    });
                })
                ->paginate($request->input('per_page', 10));
        }
        //savedFilterEnd
        // dd($Lisiting->count());
        // dd($Lisiting->toArray(), $originCity, $destCity, $Origin_State, $Destination_State);

        return view('livewire.backend.filters.listing-filter', compact('SaveFilter', 'Lisiting', 'auth_user', 'Search_vehicleType', 'watchlist', 'originCity', 'destCity', 'Origin_State', 'Destination_State', 'savedFilterId'))
            ->layout('layouts.authorized');
    }

    public function SaveFilteredRecords(Request $request)
    {
        // dd($request->toArray());
        $validatedData = $request->validate([
            // 'name' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:filter_records,name',
        ]);

        if (isset($request->filter_id) && $request->filter_id != 0) {
            $filter = Filter::find($request->filter_id);

            if (!$filter) {
                $filter = new Filter;
            }
        } else {
            $filter = new Filter;
        }

        if ($request->has('Rating') && is_array($request->Rating) && !empty($request->Rating[0])) {
            $rating = implode(',', $request->Rating);
        } else {
            $rating = null;
        }

        $filter->fill([
            'user_id' => Auth::guard('Authorized')->user()->id,
            'name' => $request->name,
            'origin_address' => $request->Origin_Address ?? null,
            'Origin_City' => $request->Origin_City ?? null,
            'Origin_State' => $request->Origin_State ?? null,
            'destination_address' => isset($request->Destination_Address) ? implode(',', $request->Destination_Address) : null,
            'Dest_City' => $request->Dest_City ?? null,
            'Destination_State' => $request->Destination_State ?? null,
            'posted_hours' => $request->Posted_Hrs ?? null,
            'shipper_prefer' => $request->Shipper_Preferences ?? null,
            'vehicle_type' => $request->Vehcile_Type ?? null,
            'vehicle_condition' => $request->Vehcile_Condition ?? null,
            'trailer_type' => $request->Trailer_Type ?? null,
            'origin_radius' => $request->Origin_Radius ?? null,
            'destination_radius' => $request->Destination_Radius ?? null,
            'comp_active' => $request->compActive ?? null,
            'equipment_type' => $request->Equipment_Type ?? null,
            'origin_zip_code' => $request->Origin_ZipCode ?? null,
            'destination_zip_code' => $request->Destination_ZipCode ?? null,
            'min_total_pay' => $request->Min_Total_Pay ?? null,
            'min_rate_pay' => $request->Min_Rate_Pay ?? null,
            'payment_type' => $request->Payment_Type ?? null,
            'min_vehicle' => $request->Min_Vehicle ?? null,
            'max_vehicle' => $request->Max_Vehicle ?? null,
            'shipment_prefrences' => $request->Shipment_Prefrences ?? null,
            'trailer_specification' => $request->Trailer_Specification ?? null,
            'min_length' => $request->Min_Length ?? null,
            'max_length' => $request->Max_Length ?? null,
            'min_width' => $request->Min_Width ?? null,
            'max_width' => $request->Max_Width ?? null,
            'min_height' => $request->Min_Height ?? null,
            'max_height' => $request->Max_Height ?? null,
            'min_weight' => $request->Min_Weight ?? null,
            'max_weight' => $request->Max_Weight ?? null,
            'freight_equipment_type' => $request->Fright_Equipment_Type ?? null,
            'freight_shipment_prefrences' => $request->Fright_Shipment_Prefrences ?? null,
            'freight_trailer_specification' => $request->Fright_Trailer_Specification ?? null,
            'freight_class' => $request->Freight_Class ?? null,
            'min_freight_weight' => $request->Min_Freight_Weight ?? null,
            'max_freight_weight' => $request->Max_Freight_Weight ?? null,
            'state' => isset($request->option) ? implode(',', $request->option) : null,
            'single_state' => $request->state ?? null,
            'rating' => $rating ?? null,
        ]);

        $filter->save();
        // dd($filter->toArray());

        return back()->with('message', 'Record saved successfully!');
    }

    public function DeleteFilteredRecords(Request $request, $id)
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        Filter::where('id', $id)->where('user_id', $user_id)->delete();
        return redirect()->back();
    }

    public function getState(Request $request): string
    {
        if ($request->ajax()) {
            $getQuery = strtoupper(trim($request->name)); // Convert input to uppercase

            $output = '';
            if ($getQuery) {
                // Use DISTINCT to get unique states
                $data = DB::table('zip_codes')
                    ->select('state')
                    ->whereRaw('SUBSTRING_INDEX(SUBSTRING_INDEX(state, ", ", -2), ",", 1) = ?', [$getQuery])
                    ->distinct()
                    ->get();

                if ($data->isNotEmpty()) {
                    $output = '<ul class="list-group auto-complete-data" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row) {
                        $output .= '<li class="list-group-item">' . $row->state . '</li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<ul class="list-group auto-complete-data" style="display: block; position: relative; z-index: 1"><li class="list-group-item">No Data Found</li></ul>';
                }
            }
            return $output;
        }
        return 'Ajax Failed!';
    }

    public function getCity(Request $request): string
    {
        if ($request->ajax()) {
            $getQuery = trim($request->name);

            $output = '';
            if ($getQuery) {
                $data = DB::table('zip_codes')
                    ->select('city', 'state')
                    ->where('city', 'LIKE', "%{$getQuery}%")
                    ->distinct()
                    ->get();

                if ($data->isNotEmpty()) {
                    $output = '<ul class="list-group auto-complete-data" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row) {
                        // Set city in the list item and the state in a hidden input
                        $output .= '<li class="list-group-item">'
                            . $row->city . ', ' . $row->state
                            . '<input type="hidden" class="state_name" value="' . $row->state . '">'
                            . '</li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<ul class="list-group auto-complete-data" style="display: block; position: relative; z-index: 1"><li class="list-group-item">No Data Found</li></ul>';
                }
            }
            return $output;
        }
        return 'Ajax Failed!';
    }

    public function getZipcode(Request $request): string
    {
        if ($request->ajax()) {
            $getQuery = trim($request->name); // Assuming 'name' is the field to search

            $output = '';
            if ($getQuery) {
                // Corrected the query to search by zipcode
                $data = DB::table('zip_codes')
                    ->where('zipcode', 'LIKE', "%{$getQuery}%")  // Corrected query for zipcode
                    ->get();

                if ($data->isNotEmpty()) {
                    $output = '<ul class="list-group auto-complete-data" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row) {
                        // Displaying only the zipcode in the list item
                        $output .= '<li class="list-group-item">'
                            . $row->zipcode
                            . '</li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<ul class="list-group auto-complete-data" style="display: block; position: relative; z-index: 1"><li class="list-group-item">No Data Found</li></ul>';
                }
            }
            return $output;
        }
        return 'Ajax Failed!';
    }

    public function getOriginLocation(Request $request): string
    {
        if ($request->ajax()) {
            $getQuery = trim($request->name);
            $output = '';

            if ($getQuery) {
                if (is_numeric($getQuery)) {
                    $data = DB::table('zip_codes')
                        ->where('zipcode', 'LIKE', $getQuery . '%')
                        ->get();
                } elseif (strlen($getQuery) === 2) {
                    $data = DB::table('zip_codes')
                        ->where('state', 'LIKE', $getQuery . '%')
                        ->get();
                } else {
                    $data = DB::table('zip_codes')
                        ->where('city', 'LIKE', $getQuery . '%')
                        // ->orWhere('county', 'LIKE', $getQuery . '%')
                        // ->orWhere('statefull', 'LIKE', $getQuery . '%')
                        ->get();
                }

                // Build the output
                if (count($data) > 0) {
                    $output = '<ul class="list-group auto-complete-data" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row) {
                        $output .= '<li class="list-group-item">' . $row->city . ', ' . $row->state . ', ' . $row->zipcode .
                            '<input hidden type="text" class="city_name" value="' . $row->city . '">' .
                            '<input hidden type="text" class="state_name" value="' . $row->state . '">' .
                            '<input hidden type="text" class="zipcode" value="' . $row->zipcode . '"></li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">No Data Found</li>';
                }
            }

            return $output;
        }

        return 'Ajax Failed!';
    }

    public function getUserRating($userId)
    {
        $orderRatings = app(\App\Services\OrderRatings::class);
        $ratings = $orderRatings->getUserRating($userId);
        $ratingsCount = $orderRatings
            ->getUserRatingRecords($userId)
            ->count();

        return [
            'ratings' => $ratings,
            'count' => $ratingsCount,
        ];
    }

    public function getFilteredData(Request $request): ?JsonResponse
    {
        // dd($request->toArray());
        $perPage = $request->input('per_page', 10);
        try {
            if ($request->ajax()) {
                // Log::info('Request Data:', $request->all());
                $originAddress = $request->input('Origin_Address');
                $originCity = $request->input('Origin_City');
                $destCity = $request->input('Dest_City');
                $Origin_State = $request->input('Origin_State');
                $Destination_State = $request->input('Destination_State');
                $Origin_ZipCode_single = $request->input('Origin_ZipCode_single');
                $Destination_ZipCode_single = $request->input('Destination_ZipCode_single');
                $postedHours = (int) $request->input('Posted_Hrs');
                $Ship_Ready = (int) $request->input('Ship_Ready');
                $Prop_Date = $request->input('Prop_Date');
                $shipperPrefer = $request->input('Shipper_Preferences');
                $vehicleCondition = $request->input('Vehcile_Condition');
                $trailerType = $request->input('Trailer_Type');
                $originRadius = $request->input('Origin_Radius');
                $destinationRadius = $request->input('Destination_Radius');
                $compActive = $request->input('compActive');
                $equipmentType = $request->input('Equipment_Type');
                $originZipCode = $request->input('Origin_ZipCode');
                $destinationZipCode = $request->input('Destination_ZipCode');
                $MinTotalPay = $request->input('Min_Total_Pay');
                $MinRatePay = $request->input('Min_Rate_Pay');
                $PaymentType = $request->input('Payment_Type');
                $MinVehicle = $request->input('Min_Vehicle');
                $MaxVehicle = $request->input('Max_Vehicle');
                $Shipment_Prefrences = $request->input('Shipment_Prefrences');
                $Trailer_Specification = $request->input('Trailer_Specification');
                $Min_Length = $request->input('Min_Length');
                $Max_Length = $request->input('Max_Length');
                $Min_Width = $request->input('Min_Width');
                $Max_Width = $request->input('Max_Width');
                $Min_Height = $request->input('Min_Height');
                $Max_Height = $request->input('Max_Height');
                $Min_Weight = $request->input('Min_Weight');
                $Max_Weight = $request->input('Max_Weight');
                $Fright_Equipment_Type = $request->input('Fright_Equipment_Type');
                $Fright_Shipment_Prefrences = $request->input('Fright_Shipment_Prefrences');
                $Fright_Trailer_Specification = $request->input('Fright_Trailer_Specification');
                $Freight_Class = $request->input('Freight_Class');
                $Min_Freight_Weight = $request->input('Min_Freight_Weight');
                $Max_Freight_Weight = $request->input('Max_Freight_Weight');
                $state = $request->input('state');
                $user_id = $request->input('user_id');
                $Rating = $request->input('Rating');
                $Sorting = $request->input('sorting');
                $vehicleType = $request->input('Vehcile_Type');

                preg_match('/\(([^,]+),\s*([^)]+)\)/', $compActive, $matches);
                $companyCity = $matches[1] ?? null;
                $companyState = $matches[2] ?? null;

                $companyName = explode('(', $compActive)[0] ?? null;
                $companyName = trim($companyName);

                $selectedRegions = $request->input('option');

                $statesMap = [
                    "NorthEast" => ['CT', 'DE', 'MA', 'ME', 'NH', 'NJ', 'NY', 'PA', 'RI', 'VT'],
                    "SouthEast" => ['AL', 'DC', 'FL', 'GA', 'KY', 'MD', 'NC', 'SC', 'TN', 'VA', 'WV'],
                    "MiddleWest Plains" => ['IA', 'IL', 'IN', 'KS', 'MI', 'MN', 'MO', 'ND', 'NE', 'OH', 'SD', 'WI'],
                    "South" => ['AR', 'LA', 'MS', 'OK', 'TX'],
                    "NorthWest" => ['ID', 'MT', 'OR', 'WA', 'WY'],
                    "SouthWest" => ['AZ', 'CA', 'CO', 'NM', 'NV', 'UT'],
                    "Pacific" => ['AK', 'HI']
                ];

                $allStates = [];
                if (is_array($selectedRegions)) {
                    foreach ($selectedRegions as $region) {
                        $allStates = array_merge($allStates, $statesMap[$region] ?? []);
                    }
                }

                $allStates = array_unique($allStates);

                $destinationAddresses = $request->input('Destination_Address');
                $statesMap = [
                    "NorthEast" => ['CT', 'DE', 'MA', 'ME', 'NH', 'NJ', 'NY', 'PA', 'RI', 'VT'],
                    "SouthEast" => ['AL', 'DC', 'FL', 'GA', 'KY', 'MD', 'NC', 'SC', 'TN', 'VA', 'WV'],
                    "MiddleWest Plains" => ['IA', 'IL', 'IN', 'KS', 'MI', 'MN', 'MO', 'ND', 'NE', 'OH', 'SD', 'WI'],
                    "South" => ['AR', 'LA', 'MS', 'OK', 'TX'],
                    "NorthWest" => ['ID', 'MT', 'OR', 'WA', 'WY'],
                    "SouthWest" => ['AZ', 'CA', 'CO', 'NM', 'NV', 'UT'],
                    "Pacific" => ['AK', 'HI']
                ];

                $destinationStates = [];
                if (is_array($destinationAddresses)) {
                    foreach ($destinationAddresses as $address) {
                        $destinationStates = array_merge($destinationStates, $statesMap[$address] ?? []);
                    }
                }

                $destinationStates = array_unique($destinationStates);

//                $originLatLng = $this->getLatitudeFromZipcode($originZipCode);
//                $originLatitude = $originLatLng['latitude'] ?? null;
//                $originLongitude = $originLatLng['longitude'] ?? null;
//
//                $destLatLng = $this->getLatitudeFromZipcode($destinationZipCode);
//                $destinationLatitude = $destLatLng['latitude'] ?? null;
//                $destinationLongitude = $destLatLng['longitude'] ?? null;

                if ($shipperPrefer == 1) {
                    $Lisiting = AllUserListing::query()
                        ->active();
                } else {
                    $Lisiting = AllUserListing::query()
                        ->whereHas('My_Network', fn($q) => $q->where('status', '!=', 1))
                        ->active();
                }
                // for user ratings

                $ratings = [];
                $userIds = [];
                $avg_ratings = [];
                $user_ratings = [];



                if (!empty($request->Rating) && is_array($request->Rating) && !empty($request->rating[0])) {
                    $users = AuthorizedUsers::all();

                    foreach ($users as $user) {
                        $userRatings = $this->getUserRating($user->id);
                        $ratingsData = $userRatings['ratings'];
                        $ratingsCount = $userRatings['count'];

                        $avg_rating = null;
                        if ($ratingsData && $ratingsCount > 0) {
                            $avg_rating = array_sum([
                                    $ratingsData->ratings_avg_timeliness ?? 0,
                                    $ratingsData->ratings_avg_communication ?? 0,
                                    $ratingsData->ratings_avg_documentation ?? 0,
                                ]) / 3;
                        }

                        if ($avg_rating !== null) {
                            $user_ratings[$user->id] = (float) $avg_rating;
                        }

                        $ratings[] = $ratingsData;
                        $userIds[] = $user->id;
                        $avg_ratings[] = $avg_rating;
                    }

                    $userIds = [];

                    foreach ($request->Rating as $value) {
                        $filterRating = (float) $value;

                        $filtered_user_ratings = array_filter($user_ratings, function ($rating) use ($filterRating) {
                            $roundedRating = floor($rating);
                            $roundedFilterRating = floor($filterRating);
                            return $roundedRating == $roundedFilterRating;
                        });

                        $userIds = array_merge($userIds, array_keys($filtered_user_ratings));
                    }

                    $userIds = array_unique($userIds);

                    $Lisiting = $Lisiting->whereIn('user_id', $userIds);

                    // dd($userIds);
                }

                $Lisiting = $Lisiting->when(!empty($companyName) && !empty($companyCity) && !empty($companyState), function ($query) use ($companyName, $companyCity, $companyState) {
                    $query->whereHas('authorized_user', function ($subQuery) use ($companyName, $companyCity, $companyState) {
                        $subQuery
                            ->where('Company_Name', 'LIKE', "%$companyName%")
                            ->where('Company_City', 'LIKE', "%$companyCity%")
                            ->where('Company_State', 'LIKE', "%$companyState%");
                    });
                })
                    ->when(!empty($Sorting), function ($query) use ($Sorting) {
                        $query->whereHas('authorized_user', function ($subQuery) use ($Sorting) {
                            $subQuery->orderBy('id');
                        });
                    })->with([
                        'authorized_user' => function ($query) use ($Sorting) {
                            $query->orderBy('id');
                        }
                    ])
                    // ->when(!empty($Rating), function ($query) use ($Rating, $user_ratings) {
                    //     $query->whereHas('authorized_user', function ($subQuery) use ($Rating, $user_ratings) {
                    //         $subQuery->havingRaw('AVG(ratings_avg_timeliness + ratings_avg_communication + ratings_avg_documentation) / 3 >= ?', [$Rating]);
                    //     });
                    // })
                    ->when(!empty($originAddress), function ($query) use ($originAddress) {
                        $query->whereHas('routes', function ($subQuery) use ($originAddress) {
                            $subQuery->where('Origin_ZipCode', $originAddress);
                        });
                    })
                    // ->when(!empty($Origin_State), function ($query) use ($Origin_State) {
                    //     $query->whereHas('routes', function ($subQuery) use ($Origin_State) {
                    //         $subQuery->where('Origin_ZipCode', 'LIKE', "%$Origin_State%");
                    //     });
                    // })
                    ->when(!empty($Origin_State), function ($query) use ($Origin_State) {
                        $Origin_State = strtoupper($Origin_State);
                        $query->whereHas('routes', function ($subQuery) use ($Origin_State) {
                            $subQuery->whereRaw("BINARY `Origin_ZipCode` LIKE ?", ["%$Origin_State%"]);
                        });
                    })
                    ->when(!empty($Origin_ZipCode_single), function ($query) use ($Origin_ZipCode_single) {
                        $query->whereHas('routes', function ($subQuery) use ($Origin_ZipCode_single) {
                            // $subQuery->whereRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(Origin_ZipCode, ',', -1)) = ?", [$Origin_ZipCode_single]);
                            $subQuery->where('Origin_ZipCode', 'LIKE', "%$Origin_ZipCode_single%");
                        });
                    })
                    ->when(!empty($Destination_ZipCode_single), function ($query) use ($Destination_ZipCode_single) {
                        $query->whereHas('routes', function ($subQuery) use ($Destination_ZipCode_single) {
                            $subQuery->whereRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(Dest_ZipCode, ',', -1)) = ?", [$Destination_ZipCode_single]);
                        });
                    })
                    ->when(!empty($Destination_ZipCode_single), function ($query) use ($Destination_ZipCode_single) {
                        $query->whereHas('routes', function ($subQuery) use ($Destination_ZipCode_single) {
                            $subQuery->where('Dest_ZipCode', 'LIKE', "%$Destination_ZipCode_single");
                        });
                    })
                    // ->when(!empty($Destination_State), function ($query) use ($Destination_State) {
                    //     $query->whereHas('routes', function ($subQuery) use ($Destination_State) {
                    //         $subQuery->where('Dest_ZipCode', 'LIKE', "%, $Destination_State,%");
                    //     });
                    // })
                    ->when(!empty($Destination_State), function ($query) use ($Destination_State) {
                        $Destination_State = strtoupper($Destination_State);
                        $query->whereHas('routes', function ($subQuery) use ($Destination_State) {
                            $subQuery->whereRaw("BINARY `Dest_ZipCode` LIKE ?", ["%$Destination_State%"]);
                        });
                    })
                    ->when(!empty($originCity), function ($query) use ($originCity) {
                        // Split the cities by comma and trim any whitespace
                        $cities = array_map('trim', explode(',', $originCity));

                        $query->whereHas('routes', function ($subQuery) use ($cities) {
                            $subQuery->where(function ($q) use ($cities) {
                                foreach ($cities as $city) {
                                    $q->orWhere('Origin_ZipCode', 'LIKE', "$city%");
                                }
                            });
                        });
                    })
                    ->when(!empty($destCity), function ($query) use ($destCity) {
                        $query->whereHas('routes', function ($subQuery) use ($destCity) {
                            $subQuery->where('Dest_ZipCode', 'LIKE', "$destCity%");
                        });
                    })
                    ->when(!empty($MinTotalPay), function ($query) use ($MinTotalPay) {
                        $query->whereHas('paymentinfo', function ($subQuery) use ($MinTotalPay) {
                            $subQuery->where('Price_Pay_Carrier', '>=', $MinTotalPay);
                        });
                    })
                    // ->when(!empty($MinRatePay), function ($query) use ($MinRatePay) {
                    //     $query->whereHas('routes', function ($subQuery) use ($MinRatePay) {
                    //         $subQuery->where('Miles', 'LIKE', "%$MinRatePay%");
                    //     });
                    // })
                    ->when(!empty($MinRatePay), function ($query) use ($MinRatePay) {
                        $query->whereHas('paymentinfo', function ($subQuery) use ($MinRatePay) {
                            $subQuery->whereRaw('(Price_Pay_Carrier / (select Miles from listing_routes where listing_routes.order_id = listing_payment_infos.order_id limit 1)) >= ?', [floatval($MinRatePay)]);
                        });
                    })
                    ->when(!empty($equipmentType), function ($query) use ($equipmentType) {
                        $query->whereHas('heavy_equipments', function ($subQuery) use ($equipmentType) {
                            $subQuery->where(function ($query) use ($equipmentType) {
                                foreach ($equipmentType as $type) {
                                    $query->orWhere('Trailer_Type', '=', $type);
                                }
                            });
                        });
                    })
                    ->when(!empty($Min_Length) && !empty($Max_Length), function ($query) use ($Min_Length, $Max_Length) {
                        $query->whereHas('heavy_equipments', function ($subQuery) use ($Min_Length, $Max_Length) {
                            $subQuery->whereBetween('Equip_Length', [$Min_Length, $Max_Length]);
                        });
                    })
                    ->when(!empty($Min_Width) && !empty($Max_Width), function ($query) use ($Min_Width, $Max_Width) {
                        $query->whereHas('heavy_equipments', function ($subQuery) use ($Min_Width, $Max_Width) {
                            $subQuery->whereBetween('Equip_Width', [$Min_Width, $Max_Width]);
                        });
                    })
                    ->when(!empty($Min_Height) && !empty($Max_Height), function ($query) use ($Min_Height, $Max_Height) {
                        $query->whereHas('heavy_equipments', function ($subQuery) use ($Min_Height, $Max_Height) {
                            $subQuery->whereBetween('Equip_Height', [$Min_Height, $Max_Height]);
                        });
                    })
                    ->when(!empty($Min_Weight) && !empty($Max_Weight), function ($query) use ($Min_Weight, $Max_Weight) {
                        $query->whereHas('heavy_equipments', function ($subQuery) use ($Min_Weight, $Max_Weight) {
                            $subQuery->whereBetween('Equip_Weight', [$Min_Weight, $Max_Weight]);
                        });
                    })
                    ->when(!empty($Shipment_Prefrences), function ($query) use ($Shipment_Prefrences) {
                        $query->whereHas('heavy_equipments', function ($subQuery) use ($Shipment_Prefrences) {
                            $subQuery->where(function ($query) use ($Shipment_Prefrences) {
                                foreach ($Shipment_Prefrences as $preference) {
                                    $query->orWhere('Shipment_Preferences', '=', $preference);
                                }
                            });
                        });
                    })
                    ->when(!empty($Trailer_Specification), function ($query) use ($Trailer_Specification) {
                        $query->whereHas('heavy_equipments', function ($subQuery) use ($Trailer_Specification) {
                            $subQuery->where(function ($query) use ($Trailer_Specification) {
                                foreach ($Trailer_Specification as $specification) {
                                    $query->orWhere('Trailer_Specification', '=', $specification);
                                }
                            });
                        });
                    })
                    ->when(!empty($destinationStates), function ($query) use ($destinationStates) {
                        $query->whereHas('routes', function ($subQuery) use ($destinationStates) {
                            $subQuery->where(function ($query) use ($destinationStates) {
                                foreach ($destinationStates as $dest_state) {
                                    $query->orWhereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(Dest_ZipCode, ',', 2), ',', -1) LIKE ?", ["%$dest_state%"]);
                                }
                            });
                        });
                    })
                    ->when(!empty($allStates), function ($query) use ($allStates) {
                        $query->whereHas('routes', function ($subQuery) use ($allStates) {
                            $subQuery->where(function ($query) use ($allStates) {
                                foreach ($allStates as $state) {
                                    $query->orWhereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(Origin_ZipCode, ',', 2), ',', -1) LIKE ?", ["%$state%"]);
                                }
                            });
                        });
                    })
                    ->when(!empty($state), function ($query) use ($state) {
                        $query->whereHas('routes', function ($subQuery) use ($state) {
                            $subQuery->whereRaw('SUBSTRING_INDEX(SUBSTRING_INDEX(Origin_ZipCode, ", ", -2), ",", 1) = ?', [$state]);
                        });
                    })
                    ->when(!empty($PaymentType), function ($query) use ($PaymentType) {
                        // $query->whereHas('paymentinfo', function ($subQuery) use ($PaymentType) {
                        //     $subQuery->where(function ($query) use ($PaymentType) {
                        //         foreach ($PaymentType as $type) {
                        //             $query->orWhere('Payment_Method_Mode', '=', $type);
                        //         }
                        //     });
                        // });
                        $query->whereHas('paymentinfo', function ($subQuery) use ($PaymentType) {
                            $subQuery->whereIn('Payment_Method_Mode', $PaymentType);
                        });
                    })
                    ->when(!empty($postedHours), function ($query) use ($postedHours) {
                        $query->where('created_at', '>=', Carbon::now()->subHours($postedHours));
                    })
                    ->when(!empty($Ship_Ready), function ($query) use ($Ship_Ready) {
                        $endDate = now()->addDays($Ship_Ready);

                        $query->whereHas('pickup_delivery_info', function ($subQuery) use ($endDate) {
                            $subQuery->whereBetween('Pickup_Date', [now()->startOfDay(), $endDate]);
                        });
                    })
                    ->when(!empty($Prop_Date), function ($query) use ($Prop_Date, $Lisiting) {
                        $query->whereHas('pickup_delivery_info', function ($subQuery) use ($Prop_Date) {
                            $subQuery->whereDate('Delivery_Date', $Prop_Date);
                        });
                    })
                    ->when(!empty($vehicleType), function ($query) use ($vehicleType) {
                        if (is_array($vehicleType)) {
                            $query->whereHas('vehicles', function ($subQuery) use ($vehicleType) {
                                $subQuery->where(function ($q) use ($vehicleType) {
                                    foreach ($vehicleType as $type) {
                                        $q->orWhere('Vehcile_Type', 'LIKE', "%$type%");
                                    }
                                });
                            });
                        }
                    })
                    // ->when(!empty($vehicleCondition), function ($query) use ($vehicleCondition) {
                    //     // dd($vehicleCondition);
                    //     $query->whereHas('vehicles', function ($subQuery) use ($vehicleCondition) {
                    //         $subQuery->where(function ($query) use ($vehicleCondition) {
                    //             foreach ($vehicleCondition as $condition) {
                    //                 $query->orWhere('Vehcile_Condition', '=', $condition);
                    //             }
                    //         });
                    //     });
                    // })
                    ->when(!empty($vehicleCondition), function ($query) use ($vehicleCondition) {
                        $query->whereHas('vehicles', function ($subQuery) use ($vehicleCondition) {
                            $subQuery->whereIn('Vehcile_Condition', $vehicleCondition);
                        });
                    })
                    ->when(!empty($trailerType), function ($query) use ($trailerType) {
                        $query->whereHas('vehicles', function ($subQuery) use ($trailerType) {
                            $subQuery->where(function ($query) use ($trailerType) {
                                foreach ($trailerType as $type) {
                                    $query->orWhere('Trailer_Type', '=', $type);
                                }
                            });
                        });
                    })
                    ->when(!empty($Fright_Equipment_Type), function ($query) use ($Fright_Equipment_Type) {
                        $query->whereHas('dry_vans', function ($subQuery) use ($Fright_Equipment_Type) {
                            $subQuery->where(function ($query) use ($Fright_Equipment_Type) {
                                foreach ($Fright_Equipment_Type as $type) {
                                    $query->orWhere('Trailer_Type_Dry', '=', $type);
                                }
                            });
                        });
                    })
                    ->when(!empty($Fright_Shipment_Prefrences), function ($query) use ($Fright_Shipment_Prefrences) {
                        $query->whereHas('dry_vans', function ($subQuery) use ($Fright_Shipment_Prefrences) {
                            $subQuery->where(function ($query) use ($Fright_Shipment_Prefrences) {
                                foreach ($Fright_Shipment_Prefrences as $preference) {
                                    $query->orWhere('Shipment_Preferences', '=', $preference);
                                }
                            });
                        });
                    })
                    ->when(!empty($Fright_Trailer_Specification), function ($query) use ($Fright_Trailer_Specification) {
                        $query->whereHas('dry_vans', function ($subQuery) use ($Fright_Trailer_Specification) {
                            $subQuery->where(function ($query) use ($Fright_Trailer_Specification) {
                                foreach ($Fright_Trailer_Specification as $specification) {
                                    $query->orWhere('Trailer_Specification_Dry', '=', $specification);
                                }
                            });
                        });
                    })
                    ->when(!empty($Freight_Class), function ($query) use ($Freight_Class) {
                        $query->whereHas('dry_vans', function ($subQuery) use ($Freight_Class) {
                            $subQuery->where(function ($query) use ($Freight_Class) {
                                foreach ($Freight_Class as $class) {
                                    $query->orWhere('Freight_Class', '=', $class);
                                }
                            });
                        });
                    })
                    ->when(!empty($Min_Freight_Weight) && !empty($Max_Freight_Weight), function ($query) use ($Min_Freight_Weight, $Max_Freight_Weight) {
                        $query->whereHas('dry_vans', function ($subQuery) use ($Min_Freight_Weight, $Max_Freight_Weight) {
                            $subQuery->whereBetween('Freight_Weight', [$Min_Freight_Weight, $Max_Freight_Weight]);
                        });
                    })
                    // $query->whereBetween('vehicle_count', [$MinVehicle, $MaxVehicle]);
                    // ->when(!empty($MinVehicle) && !empty($MaxVehicle), function ($query) use ($MinVehicle, $MaxVehicle) {
                    //     $query->whereHas('vehicles', function ($subQuery) use ($MinVehicle, $MaxVehicle) {
                    //         $subQuery->whereIn('Vehcile_Condition', $vehicleCondition);
                    //     });
                    // })
                    ->when(!empty($MinVehicle), function ($query) use ($MinVehicle) {
                        $query->where(function ($query) use ($MinVehicle) {
                            // Filter for vehicles with minimum count
                            $query->orWhereHas('vehicles', function ($subQuery) use ($MinVehicle) {
                                $subQuery->selectRaw('count(*) as vehicle_count')
                                    ->groupBy('order_id')
                                    ->havingRaw('count(*) >= ?', [$MinVehicle]);
                            });

                            // Filter for heavy equipment with minimum count
                            $query->orWhereHas('heavy_equipments', function ($subQuery) use ($MinVehicle) {
                                $subQuery->selectRaw('count(*) as equipment_count')
                                    ->groupBy('order_id')
                                    ->havingRaw('count(*) >= ?', [$MinVehicle]);
                            });

                            // Filter for dry vans with minimum count
                            $query->orWhereHas('dry_vans', function ($subQuery) use ($MinVehicle) {
                                $subQuery->selectRaw('count(*) as dryvan_count')
                                    ->groupBy('order_id')
                                    ->havingRaw('count(*) >= ?', [$MinVehicle]);
                            });
                        });
                    })
                    ->when(!empty($MaxVehicle), function ($query) use ($MaxVehicle) {
                        $query->where(function ($query) use ($MaxVehicle) {
                            // Filter for vehicles with maximum count
                            $query->orWhereHas('vehicles', function ($subQuery) use ($MaxVehicle) {
                                $subQuery->selectRaw('count(*) as vehicle_count')
                                    ->groupBy('order_id')
                                    ->havingRaw('count(*) <= ?', [$MaxVehicle]);
                            });

                            // Filter for heavy equipment with maximum count
                            $query->orWhereHas('heavy_equipments', function ($subQuery) use ($MaxVehicle) {
                                $subQuery->selectRaw('count(*) as equipment_count')
                                    ->groupBy('order_id')
                                    ->havingRaw('count(*) <= ?', [$MaxVehicle]);
                            });

                            // Filter for dry vans with maximum count
                            $query->orWhereHas('dry_vans', function ($subQuery) use ($MaxVehicle) {
                                $subQuery->selectRaw('count(*) as dryvan_count')
                                    ->groupBy('order_id')
                                    ->havingRaw('count(*) <= ?', [$MaxVehicle]);
                            });
                        });
                    })
                    // ->when(!empty($MinVehicle), function ($query) use ($MinVehicle) {
                    //     $query->whereHas('vehicles', function ($subQuery) use ($MinVehicle) {
                    //         $subQuery->selectRaw('count(*) as vehicle_count')
                    //                  ->groupBy('order_id')
                    //                  ->havingRaw('count(*) >= ?', [$MinVehicle]);
                    //     });
                    // })
                    // ->when(!empty($MaxVehicle), function ($query) use ($MaxVehicle) {
                    //     $query->whereHas('vehicles', function ($subQuery) use ($MaxVehicle) {
                    //         $subQuery->selectRaw('count(*) as vehicle_count')
                    //                  ->groupBy('order_id')
                    //                  ->havingRaw('count(*) <= ?', [$MaxVehicle]);
                    //     });
                    // })
                    ->with([
                        'routes',
                        'additional_info' => function ($q) {
                            $q->select('id', 'order_id', 'Additional_Terms');
                        },
                        'vehicles',
                        'heavy_equipments',
                        'dry_vans',
                        'dry_vans_services',
                        'pickup_delivery_info',
                        'attachments',
                        'authorized_user',
                    ])
                    ->notExpire()->orderBy('id', 'DESC')->where('Private_Listing', 0)
                    ->paginate($request->input('per_page', 10));
                    // error_log($Lisiting);
                // dd($compActive, 'ok', $Lisiting);
//                Log::info('Fetched Data:', $Lisiting->toArray());

                if ($Lisiting) {
                    return response()->json(['html' => view('partials.filter.fetch-filtered-records', compact('Lisiting', 'shipperPrefer'))->render()]);
                }
                return response()->json(['html' => view('partials.filter.fetch-filtered-records-not-found', compact('Lisiting'))->render()]);
            }
            return response()->json(['error' => 'AJAX Not Called'], 400);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function getLatitudeFromZipcode($zipcode)
    {
        $response = Http::get("https://nominatim.openstreetmap.org/search?format=json&q={$zipcode}");
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
                return [
                    'latitude' => $data[0]['lat'],
                    'longitude' => $data[0]['lon']
                ];
            }
        }
        return null;
    }

    public function getAllCompanies(Request $request): Response
    {
        $all_user = AuthorizedUsers::with('all_listing')->where('Company_Name', 'like', '%' . $request->input('input') . '%')->where('admin_verify', '!=', 0)->get();
        // dd($all_user);

        // Wrap the JSON response within a Response object
        return new Response(response()->json($all_user)->content(), 200, ['Content-Type' => 'application/json']);
    }

    public function GetFilterData(Request $request)
    {
        $filter = Filter::find($request->filter_id);
        return new Response(response()->json($filter)->content(), 200, ['Content-Type' => 'application/json']);
    }

    public function SingleFilteredRecord(Request $request, $id)
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $filter = Filter::where('name', $id)->where('user_id', $user_id)->first();
        return $filter;
    }
}
