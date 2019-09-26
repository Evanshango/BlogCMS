<?php

namespace App\Http\Controllers;

use App\Setting;

class SettingController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $settings = Setting::first();
        return view('admin.settings.settings')->with('settings', $settings);
    }

    public function update(){

        $this->validate(request(), [
            'site_name' => 'required',
            'address' => 'required',
            'contact_email' => 'required',
            'contact_number' => 'required'
        ]);
        $settings = Setting::first();

        $settings->site_name = request()->site_name;
        $settings->address = request()->address;
        $settings->contact_email = request()->contact_email;
        $settings->contact_number = request()->contact_number;

        $settings->save();

        session()->flash('success', 'Site settings updated successfully');
        return redirect()->back();
    }
}
