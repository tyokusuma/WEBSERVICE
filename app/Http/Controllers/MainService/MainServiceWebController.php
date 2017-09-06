<?php

namespace App\Http\Controllers\MainService;

use App\Http\Controllers\Controller;
use App\MainService;
use App\User;
use Illuminate\Http\Request;

class MainServiceWebController extends Controller
{
    public function index()
    {
        $mainservices = MainService::with(['service.category'])->paginate(10);
        return view('layouts.web.mainservice.index')->with('mainservices', $mainservices);
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        // 2 TABEL YANG DIUBAH ->> USER sama SERVICE

        $service = MainService::findOrFail($id);

        if ($request->has('admin_code')) {
            flash('Sorry you can\'t edit the admin code')->error()->important();
        }

        if ($request->has('user_code')) {
            flash('Sorry you can\'t edit the user code')->error()->important();
        }

        if ($request->hasFile('profile_image')) {
            Storage::delete($mainservice->profile_image);
        }

        if ($request->has('email') && $mainservice->email != $request->email) {
            $mainservice['verified'] = User::UNVERIFIED_USER;
            $mainservice['verification_link'] = User::generateVerificationEmail();
            $mainservice->email = $request->email;
        }

        $validatorService = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z. ]+$/',
            'email' => 'required|email|unique:users', //email-> follow format valid email, unique:users -> must be unique in users table
            'gender' => 'required|in:'.User::FEMALE_GENDER.','.User::MALE_GENDER,
            'phone' => 'required|regex:/^[0-9- \s]+$/',
            'profile_image' => 'required|image',     
            'admin' => 'in:'.User::ADMIN_USER.','.User::REGULER_USER,   
            'verified' => 'in:'.User::VERIFIED_USER.','.User::UNVERIFIED_USER,
        ]);

        if ($validatorService->fails()) {
            return redirect()->back()
                ->withErrors($validatorService)
                ->withInput();
        }

        $mainservice->full_name = $request->full_name; 
        $mainservice->profile_image = $request->profile_image->store('');
        $mainservice->gender = $request->gender;
        $mainservice->phone = $request->phone;
        $mainservice->admin = $request->admin;
        $mainservice->verified = $request->verified;

        // dd($mainservice);
        $mainservice->save();
        flash('Your main service data updated successfully')->success()->important();
        return redirect()->route('view-servicedetails');
    }

    public function destroy($id)
    {
        //
    }
}
