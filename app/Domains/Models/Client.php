<?php

namespace App\Domains\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname',
    ];

    /**
     * Get the address for the client.
     */
    public function client_addresses()
    {
        return $this->hasMany('App\Domains\Models\ClientAddress');
    }
    
}
