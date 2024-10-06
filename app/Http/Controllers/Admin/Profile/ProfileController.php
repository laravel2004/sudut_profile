<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.admin.profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request){
        try {
            $user = Auth::user();
            $validateRequest = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'new_password' => 'nullable|string|min:8',
                'confirm_password' => 'nullable|string|min:8|same:new_password',
                'old_password' => 'required_with:password|string|min:8',
            ]);

            if ($validateRequest['new_password']) {
                if(Hash::check($validateRequest['old_password'], $user->password)){
                    $validateRequest['password'] = Hash::make($validateRequest['new_password']);
                }else{
                    return redirect()->back()->with('error', 'Old password is incorrect.');
                }
            }

            $user->update($validateRequest);

            return redirect()->back()->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
