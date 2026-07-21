<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view("clients.index", compact("clients"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("clients.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $client = new Client();

        $image = $request->file('photo');
        $slug = str::slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $photoName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/clients')) {
                mkdir('uploads/clients', 0777, true);
            }
            $image->move('uploads/clients', $photoName);

            $client->photo = $photoName;
        }

        $client->name = $request->name;
        $client->document = $request->document;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->status = 1;
        $client->registered_by = $request->user()->id;
        $client->save();

        return redirect()->route("clients.index")->with("success", "Client successfully added.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::find($id);
        return view("clients.edit", compact("client"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        $client = Client::find($id);

        $image = $request->file('photo');
        $slug = str::slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $photoName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/clients')) {
                mkdir('uploads/clients', 0777, true);
            }
            $image->move('uploads/clients', $photoName);

            $client->photo = $photoName;
        }

        $client->name = $request->name;
        $client->document = $request->document;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->status = 1;
        $client->registered_by = $request->user()->id;
        $client->save();

        return redirect()->route("clients.index")->with("success", "Client successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route("clients.index")->with("success", "The client has been deleted.");
    }

    public function changeclienturl(Request $request)
    {
        $product = Client::find($request->client_id);
        $product->status = $request->status;
        $product->save();
    }
}
