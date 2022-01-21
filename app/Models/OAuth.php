<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\OAuth2\Client\Provider\GenericProvider;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class OAuth extends Model
{
    use HasFactory;

    public $table = 'oauth';

    protected $fillable = ['provider', 'state', 'access_token', 'refresh_token', 'expires_at'];

    public function getProvider(): GenericProvider
    {
        return $this->initProvider($this->provider);
    }

    public static function initProvider($providerName): GenericProvider
    {
        if (!config($providerName . '.client_id')) {
            throw new Exception('OAuth Service is unknown');
        }

        return new GenericProvider([
            'clientId'                => config($providerName . '.client_id'),
            'clientSecret'            => config($providerName . '.secret'),
            'redirectUri'             => url('api/oauth/' . $providerName . '/callback'),
            'urlAuthorize'            => config($providerName . '.authorize_url'),
            'urlAccessToken'          => config($providerName . '.access_token_url'),
            'urlResourceOwnerDetails' => config($providerName . '.resource_owner_details_url'),
            'scopes'                  => config($providerName . '.scopes')
        ]);
    }

    public function getAuthenticatedResponse($method, $url)
    {
        $provider = $this->getProvider();

        if (now()->gte($this->expires_at)) {
            info('Refreshing token');
            try {
                $newAccessToken = $provider->getAccessToken('refresh_token', [
                    'refresh_token' => $this->refresh_token
                ]);
            } catch (\Exception $e) {
                logger()->error($e);
                throw new ServiceUnavailableHttpException();
            }

            $this->update([
                'access_token' => $newAccessToken->getToken(),
                'refresh_token' => $newAccessToken->getRefreshToken(),
                'expires_at' => Carbon::parse($newAccessToken->getExpires())
            ]);
        }

        $client = new Client;
        $response = $client->request($method, config($this->provider . '.endpoint') . '/' . $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->access_token,
                'Accept'        => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
