<?php

namespace App\Domains\Repositories;

use App\Domains\Interfaces\ClientInterface;
use App\Domains\Models\Client;


class ClientRepository implements ClientInterface {

    public function getClients(){
       return Client::all()->toArray();
    }
    public function getClientById($id) {
        return Client::where(['id' => $id])->get()->toArray();
    }
}
