<?php

namespace App\Services\Socialite;

use App\Models\UserProvider;

class UserProviderStore
{
    /**
     * @param $provider
     * @param $providerUser
     * @return UserProvider|null
     */
    public function getByProvider($provider, $id)
    {
        return UserProvider::where('provider', $provider)
            ->where('provider_user_id', $id)
            ->first();
    }

    public function flush($user, $provider)
    {
        UserProvider::where('user_id', $user->getKey())
            ->where('provider', $provider)
            ->delete();
    }

}
