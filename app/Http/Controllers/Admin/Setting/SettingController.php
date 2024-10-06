<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private Setting $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $setting = $this->setting->first();
        return view('pages.admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validateRequest = $request->validate([
            'app_name' => 'required',
            'app_description' => 'required',
            'app_profile' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'app_telp' => 'nullable',
            'app_email' => 'nullable',
            'app_favicon' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'app_ig' => 'nullable',
            'app_linkedin' => 'nullable',

        ]);

        $setting = $this->setting->first();
        if ($request->hasFile('app_profile')) {
            $image = $request->file('app_profile');
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('storage/logo'), $image_name);
            $setting->app_profile = $image_name;
        }

        if ($request->hasFile('app_favicon')) {
            $image = $request->file('app_favicon');
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('storage/logo'), $image_name);
            $setting->app_favicon = $image_name;
        }

        $setting->app_name = $validateRequest['app_name'];
        $setting->app_description = $validateRequest['app_description'];
        $setting->app_telp = $validateRequest['app_telp'];
        $setting->app_email = $validateRequest['app_email'];
        $setting->app_ig = $validateRequest['app_ig'];
        $setting->app_linkedin = $validateRequest['app_linkedin'];
        $setting->save();

        return redirect()->back()->with('success', 'Setting has been updated');
    }
}
