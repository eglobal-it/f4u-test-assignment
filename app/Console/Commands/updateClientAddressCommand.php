<?php
/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Domains\Repositories\ClientAddressRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class UpdateClientAddressCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class UpdateClientAddressCommand extends Command
{
    private $client_address;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "update:client_address";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update client address";

    /**
     * Create a new console instance.
     *
     * @return void
     */
    public function __construct(ClientAddressRepository $client_address)
    {
        $this->client_address = $client_address;
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $request['address_id'] = $this->ask('Please provide address id:');
            $request['street'] = $this->ask('Please provide street:');
            $request['zipcode'] = $this->ask('Please provide zipcode:');
            $request['city'] = $this->ask('Please provide city:');
            $request['country'] = $this->ask('Please provide country:');

            $validator = Validator::make($request, [
                'address_id' => 'required|exists:client_addresses,id',
                'street' => 'required|min:10|max:50',
                'zipcode' => 'required|size:6',
                'city' => 'required|min:3|max:50',
                'country' => 'required|min:3|max:50',
            ]);
            if ($validator->fails()) {
                $this->info('Please check below reasons:');
                    foreach ($validator->errors()->all() as $error) {
                        $this->error($error);
                    }
                    return 1;
            } else {
                $this->client_address->updateClientAddress($request);
                $client_address_detail = $this->client_address->getClientAddressById($request['address_id']);
                $headers = ['Id', 'Client Id', 'Street', 'Zip Code', 'City', 'Country', 'Is Default', 'Created At', 'Updated At'];
                $this->table($headers, $client_address_detail);    
            }            
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
