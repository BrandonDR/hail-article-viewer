<?php

namespace App\Console\Commands;

use App\Models\OAuth;
use Illuminate\Console\Command;

class OAuthConnect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oauth:connect {provider}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates the URL to authenticate the service using OAuth';

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
        $providerName = trim(strtolower($this->argument('provider')));
        $provider = OAuth::initProvider($providerName);

        $authorizationUrl = $provider->getAuthorizationUrl();

        OAuth::updateOrCreate(
            ['provider' => $providerName],
            [
                'state' => $provider->getState(),
                'access_token' => null,
                'refresh_token' => null,
            ]
        );

        $this->info('Please authenticate this application using this URL in your browser:');
        $this->info($authorizationUrl);

        return 0;
    }
}
