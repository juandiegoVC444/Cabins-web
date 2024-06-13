<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ChangePasswordController extends Controller

{

    public function show()
    {
        return view('auth.passwords.change');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }
            ],
            
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Rule::notIn([$user->password]),
            ],
        ]);

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
