<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Repositories\ClientAddressRepository;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

const MAX_ALLOWED_CLIENT_ADDRESSES = 3;

class ClientAddressController extends Controller
{
    private $client_address;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClientAddressRepository $client_address)
    {
        $this->client_address = $client_address;
    }

    public function addClientAddress(Request $request){
        
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'street' => 'required|min:10|max:50',
            'zipcode' => 'required|size:6',
            'city' => 'required|min:10|max:50',
            'country' => 'required|min:10|max:50',
        ]);
        $validator->after(function ($validator) use ($request) {
            if ($this->isExceededClientAddressCount($request->input('client_id'))) {
                $validator->errors()->add('client_id', 'Client addresses reached the max limit.');
            }
        });
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return json_encode($this->client_address->addClientAddress($request));
        }
        
    }

    private function isExceededClientAddressCount($client_id){
        $clientAddressesCount = $this->client_address->isExceededClientAddressCount($client_id);
        if($clientAddressesCount < MAX_ALLOWED_CLIENT_ADDRESSES){
            return false;
        }
        return true;
    }

    public function updateClientAddress(Request $request){

        $this->validate($request, [
            'address_id' => 'required|exists:client_addresses,id',
            'street' => 'required|min:10|max:50',
            'zipcode' => 'required|size:6',
            'city' => 'required|min:10|max:50',
            'country' => 'required|min:10|max:50',
        ]);
        
        return json_encode($this->client_address->updateClientAddress($request));
    }

    public function setDefaultClientAddress(Request $request){
        
        $this->validate($request, [
            'address_id' => 'required|exists:client_addresses,id'
        ]);
       return json_encode($this->client_address->setDefaultClientAddress($request));
    }

    public function deleteClientAddress(Request $request){
        $this->validate($request, [
            'address_id' => 'required|exists:client_addresses,id'
        ]);
        return json_encode($this->client_address->deleteClientAddress($request));

    }
}
