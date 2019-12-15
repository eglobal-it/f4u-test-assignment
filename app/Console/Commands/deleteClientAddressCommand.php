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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * Class DeleteClientAddressCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class DeleteClientAddressCommand extends Command
{
    private $client_address;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "delete:client_address";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Delete client address";

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
            $request['id'] = $this->ask('Please provide address id:');
            $validator = Validator::make($request, [
                'id' => ['required','exists:client_addresses,id',
                Rule::exists('client_addresses')->where(function ($query) use ($request) {
                    $query->where('is_default', 0);
                }),
            ]]);
            
            if ($validator->fails()) {
                $this->info('Please check below reasons:');
                    foreach ($validator->errors()->all() as $error) {
                        $this->error($error);
                    }
                    return 1;
            } else {

                $deleted = $this->client_address->deleteClientAddress($request);
                if($deleted){
                    $this->info('Client Address deleted successfully');
                }  
            }            
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
