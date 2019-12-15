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
 * Class SetDefaultClientAddressCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class SetDefaultClientAddressCommand extends Command
{
    private $client_address;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "update:set_default_client_address";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Set default client address";

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
            
            $validator = Validator::make($request, [
                'address_id' => 'required|exists:client_addresses,id',
            ]);
            
            if ($validator->fails()) {
                $this->info('Please check below reasons:');
                    foreach ($validator->errors()->all() as $error) {
                        $this->error($error);
                    }
                    return 1;
            } else {

                $this->client_address->setDefaultClientAddress($request);
                $client_address_detail = $this->client_address->getClientAddressById($request['address_id']);
                $headers = ['Id', 'Client Id', 'Street', 'Zip Code', 'City', 'Country', 'Is Default', 'Created At', 'Updated At'];
                $this->table($headers, $client_address_detail);    
            }            
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
