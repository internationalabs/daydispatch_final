<?php

namespace App\Http\Livewire\Auth;

use App\Models\Auth\AuthorizedAgent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;

class AgentRegistration extends Component
{
    public function render()
    {
        return view('livewire.auth.agent-registration')->layout('layouts.auth-agent');
    }

    // ============== Agent Registration
    public function AgentRegistration(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'Agent_Email' => 'required|email|unique:authorized_agents,email',
                'Agent_Password' => 'required',
                'Agent_Name' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $AuthorizedAgent = new AuthorizedAgent();

            $AuthorizedAgent->email = $request->Agent_Email;
            $AuthorizedAgent->password = bcrypt($request->Agent_Password);
            $AuthorizedAgent->name = $request->Agent_Name;
            $AuthorizedAgent->Phone_Number = $request->Agent_Phone;
            $AuthorizedAgent->Address = $request->Agent_Address;
            $AuthorizedAgent->ref_code = Str::random(10);

            if ($AuthorizedAgent->save()) {
                DB::commit();
                return redirect()->route('Auth.Agent.Forms')->with('success', 'Agent registered successfully!');
            }

            DB::rollback();
            return back()->with('error', 'Failed to register agent. Please try again.');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'An error occurred while registering agent.');
        }
    }
}
