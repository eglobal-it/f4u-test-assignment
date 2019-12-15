<?php

namespace App\Domains\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'street', 'zipcode', 'city', 'country', 'is_default'
    ];


}
