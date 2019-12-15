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
use App\Domains\Repositories\ClientRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class GetClientByIdCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class GetClientByIdCommand extends Command
{
    private $client;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "get:client_by_id";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Get client by id";

    /**
     * Create a new console instance.
     *
     * @return void
     */
    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
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
                $id = $this->ask('Please provide client id:');
                $validator = Validator::make(['id' => $id], [
                    'id' => 'required|exists:clients,id'
                ]);
                if($validator->fails()){
                    $this->info('Please check below reasons:');
                    foreach ($validator->errors()->all() as $error) {
                        $this->error($error);
                    }
                    return 1;
                } else {
                    $client_details = $this->client->getClientById($id);
                    $headers = ['Id', 'First Name', 'Last Name', 'Created At', 'Updated At'];
                    $this->table($headers, $client_details);    
                }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
