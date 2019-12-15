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

const MAX_ALLOWED_CLIENT_ADDRESSES = 3;

/**
 * Class AddClientAddressCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class AddClientAddressCommand extends Command
{
    private $client_address;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "add:client_address";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Add client address";

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
            $request['client_id'] = $this->ask('Please provide client id:');
            $request['street'] = $this->ask('Please provide street:');
            $request['zipcode'] = $this->ask('Please provide zipcode:');
            $request['city'] = $this->ask('Please provide city:');
            $request['country'] = $this->ask('Please provide country:');

            $validator = Validator::make($request, [
                'client_id' => 'required|exists:clients,id',
                'street' => 'required|min:10|max:50',
                'zipcode' => 'required|size:6',
                'city' => 'required|min:3|max:50',
                'country' => 'required|min:3|max:50',
            ]);
            $validator->after(function ($validator) use ($request) {
                if ($this->isExceededClientAddressCount($request['client_id'])) {
                    $validator->errors()->add('client_id', 'Client addresses reached the max limit.');
                }
            });
            if ($validator->fails()) {
                $this->info('Please check below reasons:');
                    foreach ($validator->errors()->all() as $error) {
                        $this->error($error);
                    }
                    return 1;
            } else {
                $client_address_detail = $this->client_address->addClientAddress($request);
                $this->info('Client Address added successfully.');    
            }            
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function isExceededClientAddressCount($client_id){
        $clientAddressesCount = $this->client_address->isExceededClientAddressCount($client_id);
        if($clientAddressesCount < MAX_ALLOWED_CLIENT_ADDRESSES){
            return false;
        }
        return true;
    }
}
