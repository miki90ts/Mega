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
use App\Http\Requests\UpdateUserRequest;
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
            'query' => (object) $request->query(),
            'users' => UserResource::collection(
                User::with('profile.job_position')
                    // ->tap(function ($builder) use ($request) {
                    //     if (filled($request->search)) {
                    //         return $builder->where('last_name', 'like', "%$request->search%");
                    //     }
                    // })
                    ->where(function ($query) use ($request) {
                        $search = $request->search;
                        if (filled($search)) {
                            $query->where(function ($query) use ($search) {
                                $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"])
                                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%$search%"])
                                    ->orWhere('email', 'like', "%$search%");
                            })->orWhereHas('profile', function ($query) use ($search) {
                                $query->where('phone', 'like', "%$search%");
                            })->orWhereHas('profile', function ($query) use ($search) {
                                $query->where('mobile', 'like', "%$search%");
                            })->orWhereHas('profile.job_position', function ($query) use ($search) {
                                $query->where('title', 'like', "%$search%");
                            });
                        }
                    })
                    ->latest()
                    ->paginate(50)
            ),
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
            'password' => Hash::make('Mega123!'),
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

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        $user->profile()->update([
            'job_position_id' => $request->input('job_position_id'),
            'gender' => $request->input('gender'),
            'birthday' => Carbon::parse($request->birthday)->format('Y-m-d'),
            'city' => $request->input('city'),
            'country_id' => $request->input('country_id'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
        ]);

        return Redirect::route('users.index');
    }

    public function updateProfileImage(Request $request)
    {
        $photo = $request->photo->store('public/user/photo');
        $request->user()->profile()->update([
            'photo' =>  basename($photo),
        ]);

        //return Redirect::route('users.index');
    }
}
