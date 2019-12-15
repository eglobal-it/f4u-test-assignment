<?php

namespace App\Domains\Interfaces;

interface ClientInterface {
    public function getClients();
    public function getClientById(Integer $id);
}
