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
 * Class GetClientAddresssByClientIdCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class GetClientAddressByClientIdCommand extends Command
{
    private $client_address;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "get:get_client_address_by_client_id";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Get client address by client id";

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
                $client_id = $this->ask('Please provide client id:');
                $validator = Validator::make(['client_id' => $client_id], [
                    'client_id' => 'required|exists:client_addresses,client_id'
                ]);
                if($validator->fails()){
                    $this->info('Please check below reasons:');
                    foreach ($validator->errors()->all() as $error) {
                        $this->error($error);
                    }
                    return 1;
                } else {
                    $client_addresses = $this->client_address->getClientAddressByClient($client_id);
                    $headers = ['Id', 'Client Id', 'Street', 'Zip Code', 'City', 'Country', 'Is Default', 'Created At', 'Updated At'];
                    $this->table($headers, $client_addresses);    
                }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
