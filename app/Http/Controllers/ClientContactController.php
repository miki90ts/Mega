<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ClientContact;
use App\Http\Requests\StoreClientContactRequest;
use App\Http\Requests\UpdateClientContactRequest;
use App\Http\Resources\ClientContactsResource;
use App\Http\Resources\ClientResource;

class ClientContactController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('ClientContact/Index', [
            'query' => (object) $request->query(),

            'clients' => ClientResource::collection(Client::all()),

            'clientContacts' => ClientContactsResource::collection(
                ClientContact::with('client')
                    ->where(function ($query) use ($request) {
                        $search = $request->search;
                        if (filled($search)) {
                            $query->where(function ($query) use ($search) {
                                $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"])
                                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%$search%"])
                                    ->orWhere('phone', 'like', "%$search%")
                                    ->orWhere('job_title', 'like', "%$search%")
                                    ->orWhere('email', 'like', "%$search%");
                            })->orWhereHas('client', function ($query) use ($search) {
                                $query->where('name', 'like', "%$search%");
                            });
                        }
                    })
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
    public function store(StoreClientContactRequest $request)
    {
        $client = Client::find($request->client_id);

        $client->clientContacts()->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientContact $clientContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientContact $clientContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientContactRequest $request, ClientContact $clientContact)
    {
        $clientContact->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientContact $clientContact)
    {
        //
    }
}
