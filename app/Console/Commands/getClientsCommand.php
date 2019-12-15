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


/**
 * Class GetClientsCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class GetClientsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "get:clients";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Get all clients";

    /**
     * Create a new controller instance.
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
                $clients = $this->client->getClients();
                $headers = ['Id', 'First Name', 'Last Name', 'Created At', 'Updated At'];
                $this->table($headers, $clients);
        } catch (Exception $e) {
            $this->error("An error occurred".$e->getMessage());
        }
    }
}
