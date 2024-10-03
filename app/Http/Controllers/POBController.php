<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\POB;
use App\Models\User;

class POBController extends Controller
{
    //
    public function index()
    {
        return POB::with('user','dam')->get();
    }

    public function store(Request $request)
    {
        
        $validated=$request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique:users,email',
            'dam_id' => 'required|exists:dams,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->phone_number,
            'password' => bcrypt($request->phone_number),  // Hash the password
        ]);
    
       
        $pob = POB::create([
            'name' => $request->name,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'dam_id' => $request->dam_id,
            'user_id' => $user->id,  // Associate control point with the newly created user
        ]);
    
        return response()->json([
            'message' => 'POB and user created successfully',
            'control_point' => $pob,
            'user' => $user
        ], 201);  // 201 means resource created
    }

    public function show(POB $pob)
    {
        return $pob->with('user','dam')->find($pob->id);
    }

    public function update(Request $request, POB $pob)
    {
        $validated=$request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique:users,email,'. $pob->user_id,
            'dam_id' => 'required|exists:dams,id',
        ]);

        $pob->update([
            'name' => $request->name,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'dam_id' => $request->dam_id,
        ]);

        if ($request->phone_number !== $pob->user->email) {
            // Update the associated user's email with the new phone number
            $pob->user->update([
                'email' => $request->phone_number,  // Assuming you want phone_number as the email
            ]);
        }

        if ($request->name !== $pob->user->name) {
            // Update the associated user's email with the new phone number
            $pob->user->update([
                'name' => $request->name,  // Assuming you want phone_number as the email
            ]);
        }
    
        return response()->json([
            'message' => 'POB and user updated successfully',
            'control_point' => $pob,
            'user' => $pob->user
        ], 200);  // 200 means resource updated
    }

    public function destroy(POB $pob)
    {
        $pob->delete();
        return response()->json([
            "status"=>"OKE",
            "message"=>"pob Successfully deleted!" 
        ]);
    }
}
