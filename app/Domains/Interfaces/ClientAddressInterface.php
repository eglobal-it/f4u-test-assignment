<?php

namespace App\Domains\Interfaces;

interface ClientAddressInterface {

    public function getClientAddressByClient(Integer $client_id);
    public function addClientAddress(Array $request);
    public function updateClientAddress(Request $request);
    public function setDefaultClientAddress(Request $request);
    public function deleteClientAddress(Request $request);
}
