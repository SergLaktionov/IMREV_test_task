<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Client::with('companies')->withCount('companies')->paginate();
    }

    /**
     * Display a listing of the companies related to the client.
     */
    public function showClientCompanies(Client $client) {
        return $client->companies;
    }
}
