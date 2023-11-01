<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request, UserProfile $userProfile)
    {
        UserProfile::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'user_id' => $request->user()->id,
                'job_position_id' => $request->input('job_position_id'),
                'gender' => $request->input('gender'),
                'birthday' => Carbon::parse($request->birthday)->format('Y-m-d'),
                'city' => $request->input('city'),
                'country_id' => $request->input('country_id'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'mobile' => $request->input('mobile'),
            ]
        );

        return Redirect::route('profile.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
