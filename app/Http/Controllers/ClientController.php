<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Repositories\ClientRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

const MAX_ALLOWED_CLIENT_ADDRESSES = 3;

class ClientController extends Controller
{
    private $client;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
    }

    public function getClients(){
        $clients = $this->client->getClients();
        return json_encode($clients);
    }

    public function getClientById(Request $request){
        $this->validate($request, [
            'id' => 'required|exists:clients,id'
        ]);
        return json_encode($this->client->getClientById($request));
    }

    public function addClient(Request $request){
        $this->validate($request, [
            'firstname' => 'required|unique:clients,firstname',
            'lastname' => 'required|unique:clients,lastname',
        ]);
       return $this->client->addClient($request);
    }
}
