<?php

namespace App\Http\Livewire\Backend\Admin\Payments;

use App\Models\Payments\AgentTargetedReward;
use App\Models\Payments\PaymentSystem;
use App\Models\Payments\SubscriptionPackages;
use Illuminate\Http\Request;
use Livewire\Component;

class PaymentSettings extends Component
{
    public function render()
    {
        $Payment_Switches = PaymentSystem::get();
        // dd($Payment_Switches);
        $Packages = SubscriptionPackages::first();
        $Targeted_Reward = AgentTargetedReward::first();
        return view('livewire.backend.admin.payments.payment-settings', compact('Payment_Switches', 'Packages', 'Targeted_Reward'))->layout('layouts.authorized-admin');
    }

    public function PaymentSwitchUpdate(Request $request): string
    {
        $output = 'Ajax Call Not Received';
        if ($request->ajax()) {
            PaymentSystem::where('id', $request->Switch_ID)
                ->update([
                    'Payment_Switch' => ((int)$request->Switch_Value === 1) ? 0 : 1,
                    'Payment' => $request->Switch_Amount
                ]);
            $output = 'Payment Switch Update';
        }
        return $output;
    }

    public function SubscriptionPackage(Request $request): string
    {
        $output = 'Ajax Call Not Received';
        if ($request->ajax()) {
            SubscriptionPackages::where('id', 1)
                ->update([
                    'Heavy_Load_Amount' => $request->H_Load_Amount,
                    'Dry_Van_Load_Amount' => $request->D_Load_Amount
                ]);
            $output = 'Subscription Packages Got Updated';
        }
        return $output;
    }

    public function RevenueTarget(Request $request): string
    {
        $output = 'Ajax Call Not Received';
        if ($request->ajax()) {
            AgentTargetedReward::where('id', 1)
                ->update([
                    'Order_Target' => $request->Order,
                    'Per_Order_Amount' => $request->Revenue
                ]);
            $output = 'Revenue Target Got Updated';
        }
        return $output;
    }
}
