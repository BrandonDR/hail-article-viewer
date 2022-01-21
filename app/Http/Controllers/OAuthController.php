<?php

namespace App\Http\Controllers;

use App\Models\OAuth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OAuthController extends Controller
{
    public function callback($providerName, Request $request)
    {
        $provider = OAuth::initProvider($providerName);

        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $request->get('code')
        ]);

        $oauth = OAuth::where(['provider' => $providerName, 'state' => $request->get('state')])->firstOrFail();

        if (!$request->state || empty($request->state) || ($request->state !== $oauth->state)) {

            $oauth->delete();
            return response('Invalid request.', 401);
        }

        $oauth->update([
            'access_token' => $accessToken->getToken(),
            'refresh_token' => $accessToken->getRefreshToken(),
            'expires_at' => Carbon::parse($accessToken->getExpires())
        ]);
        info('Access Token: ' . $oauth->access_token);
        info('Refresh Token: ' . $oauth->refresh_token);
        info('Expired in: ' . $oauth->expires_at);
        info('Already expired? ' . ($accessToken->hasExpired() ? 'expired' : 'not expired'));

        return response('Success. You may close this window.');
    }
}
