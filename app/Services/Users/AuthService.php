<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 17.12.2019
 * Time: 16:49
 */

namespace App\Services\Users;

use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Token;

class AuthService
{
    /**
     * @param User $user
     * @param bool $personalAccess
     *
     * @return Client
     */
    public function createOauthClient(User $user, bool $personalAccess = true) : Client
    {
        $redirectLink = route('back-store-index');

        $repo = new ClientRepository();
        /* @var $client Client */
        $client = $repo->create(
            $user->getKey(),
            'PAC',
            $redirectLink,
            $personalAccess,
            !$personalAccess
        );
        $client->save();

        if ($personalAccess) {
            //todo trash
            $repo->createPersonalAccessClient($user->getKey(), 'PA', $redirectLink)->save();
        } else {
            $repo->createPasswordGrantClient($user->getKey(), 'PG', $redirectLink)->save();
        }
        return $client;
    }

    /**
     * @param User  $user
     * @param array $scopes
     *
     * @return Token
     */
    public function createOauthToken(User $user, array $scopes = []) : Token
    {
        $token = $user->createToken('PAT', $scopes)->token;
        $token->save();
        return $token;
    }

    /**
     * @param int    $clientId
     * @param string $clientSecret
     *
     * @return User|null
     */
    public function getUserByOauthClient(?int $clientId, ?string $clientSecret) : ?User
    {
        if (!empty($clientId) && !empty($clientSecret)) {
            /* @var $client Client */
            $client = Client::with('user')
                            ->whereKey($clientId)
                            ->whereSecret($clientSecret)
                            ->whereRevoked(false)
                            ->whereIn('name', ['PA', 'PG'])
                            ->first();

            if ($client && $client->user) {
                return $client->user;
            }
        }

        return null;
    }

    /**
     * @param string $tokenStr
     *
     * @return User|null
     */
    public function getUserByOauthToken(?string $tokenStr) : ?User
    {
        if (!empty($tokenStr)) {
            /* @var $token Token */
            $token = Token::query()
                          ->with('user')
                          ->whereKey($tokenStr)
                          ->whereRevoked(false)
                          ->first();

            if ($token && Carbon::now()->gt($token->expires_at)) {
                $token->revoke();
                $token = null;
            }

            if ($token && $token->user) {
                return $token->user;
            }
        }

        return null;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return User|null
     */
    public function getUserByLoginCredentionals(?string $email, ?string $password) : ?User
    {
        if (!empty($email) && !empty($password)) {
            /* @var $user User */
            $user = User::query()
                ->where('email', $email)
                ->first();

            if ($user && Hash::check($password, $user->getAuthPassword())) {
                return $user;
            }
        }

        return null;
    }
}