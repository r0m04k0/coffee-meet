<?php

namespace App\Console\Commands;

use App\Actions\GenerateMeetsAction;
use Illuminate\Console\Command;

class GenerateMeets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-meets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $meetMaker = new GenerateMeetsAction();
        $meetMaker();
        $this->info('Meetings generated successfully.');
    }
}
