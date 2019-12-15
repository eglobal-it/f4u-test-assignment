<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\getClientsCommand::class,
        Commands\getClientByIdCommand::class,
        Commands\getClientAddressByClientIdCommand::class,
        Commands\addClientAddressCommand::class,
        Commands\updateClientAddressCommand::class,
        Commands\setDefaultClientAddressCommand::class,
        Commands\deleteClientAddressCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
