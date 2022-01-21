<?php

namespace App\Console\Commands;

use App\Services\HailService;
use Illuminate\Console\Command;

class OrganisationList extends Command
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
    protected $description = 'List organisations of the authenticated user';

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

        $values = [];
        foreach ($organisations as $organisation) {
            $values[] = collect($organisation)->only(['id', 'name'])->toArray();
        }
        $this->table(['id', 'name'], $values);
        return 0;
    }
}
