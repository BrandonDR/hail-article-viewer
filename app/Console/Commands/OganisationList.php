<?php

namespace App\Console\Commands;

use App\Services\HailService;
use Illuminate\Console\Command;

class OganisationList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'organisation:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $organisations = HailService::getOrganisations();

        $this->info('Organisations list:');

        foreach ($organisations as $org) {
            $this->info($org->id . ' -> ' . $org->name);
        }
        return 0;
    }
}
