<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;
use App\Models\Application\Application;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\ApplicationResource;

class ApplicationController extends Controller
{

    public function index(Request $request): Response
    {
        return Inertia::render('Application/Index', [
            'query' => (object) $request->query(),

            'clients' => ClientResource::collection(Client::all()),

            'applications' => ApplicationResource::collection(
                Application::with(['client', 'servers.serverType', 'servers.logins', 'databases.databaseType', 'databases.logins'])
                    ->latest()
                    ->paginate(50)
            ),

        ]);
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
    public function store(StoreApplicationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
