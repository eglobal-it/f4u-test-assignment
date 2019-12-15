<?php

namespace App\Domains\Repositories;

use App\Domains\Interfaces\ClientAddressInterface;
use App\Domains\Models\ClientAddress;


class ClientAddressRepository implements ClientAddressInterface {

    public function getClientAddressByClient($client_id){
        return ClientAddress::where(['client_id' => $client_id])->get()->toArray();
    }

    public function getClientAddressById($id){
        return ClientAddress::where(['id' => $id])->get()->toArray();
    }

    public function addClientAddress($request){
        
        $client_address['client_id'] = $request['client_id'];
        $client_address['street'] = $request['street'];
        $client_address['zipcode'] = $request['zipcode'];
        $client_address['city'] = $request['city'];
        $client_address['country'] = $request['country'];
        $client_address_detail = ClientAddress::where(['client_id' => $request['client_id'], 'is_default' => 1])->get();
        if($client_address_detail){
            $client_address['is_default'] = 0;
        } else {
            $client_address['is_default'] = 1;
        }
        return ClientAddress::create($client_address);        
    }

    public function isExceededClientAddressCount($client_id){
        return $clientAddressesCount = ClientAddress::where(['client_id' => $client_id])->count();
    }

    public function updateClientAddress($request){

        $address_id = $request['address_id'];
        $client_address['street'] = $request['street'];
        $client_address['zipcode'] = $request['zipcode'];
        $client_address['city'] = $request['city'];
        $client_address['country'] = $request['country'];
        return ClientAddress::where(['id' => $address_id])->update($client_address);
    }

    public function setDefaultClientAddress($request){
        
        $address_id = $request['address_id'];
        $client_address = ClientAddress::find($address_id);
        ClientAddress::where(['client_id' => $client_address->client_id])->update(['is_default' => 0]);
        return ClientAddress::where(['id' => $address_id])->update(['is_default' => 1]);
    }

    public function deleteClientAddress($request){
        $address_id = $request['id'];
        return ClientAddress::where(['id' => $address_id])->delete();
    }
}
