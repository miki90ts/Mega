<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Enums\Gender;
use Inertia\Response;
use App\Models\Country;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\GenderResource;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\CountryResource;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\JobPositionResource;

class UserController extends Controller
{
    /**
     * Display the users.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('User/Index', [
            'users' => UserResource::collection(User::with('profile.job_position')->latest()->paginate(50)),
            'countries' => CountryResource::collection(Country::all()),
            'job_positions' => JobPositionResource::collection(JobPosition::all()),
            'genders' => GenderResource::collection(Gender::cases()),
        ]);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->profile()->create([
            'job_position_id' => $request->input('job_position_id'),
            'gender' => $request->input('gender'),
            'birthday' => Carbon::parse($request->birthday)->format('Y-m-d'),
            'city' => $request->input('city'),
            'country_id' => $request->input('country_id'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
        ]);

        event(new Registered($user));

        return Redirect::route('users.index');
    }
}
