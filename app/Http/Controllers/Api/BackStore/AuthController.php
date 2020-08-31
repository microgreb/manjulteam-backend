<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 17.12.2019
 * Time: 13:11
 */

namespace App\Http\Controllers\Api\BackStore;

use App\Models\Users\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Laravel\Passport\Token;

class AuthController extends BaseController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request) : JsonResponse
    {
        $user = $this
            ->authService
            ->getUserByOauthClient(
                $request->get('client_id'),
                $request->get('client_secret')
            );

        if (null === $user) {
            $user = $this
                ->authService
                ->getUserByLoginCredentionals(
                    $request->get('email'),
                    $request->get('password')
                );
        }

        if (null !== $user) {
            $user->load([
                'tokens' => function($query) {
                    $query->whereRevoked(false);
                },
                'clients' => function($query) {
                    $query
                        ->whereRevoked(false)
                        ->whereIn('name', ['PA', 'PG']);
                },
            ]);

            /* @var $client Client */
            $client = $user->clients->first();
            if (null === $client) {
                $client = $this
                    ->authService
                    ->createOauthClient($user);
            }

            /* @var $token Token */
            $token = $user->tokens->first();
            if (null === $token) {
                $token = $this
                    ->authService
                    ->createOauthToken($user, $this->scopes);
            }
            $user->withAccessToken($token);

            return $this->json([
                'client_id'     => $client->getKey(),
                'client_secret' => $client->getAttribute('secret'),
                'redirect'      => $client->redirect,
            ], 'Logged in');
        }

        return $this->unauthorized();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function token(Request $request) : JsonResponse
    {
        $user = $this
            ->authService
            ->getUserByOauthClient(
                $request->get('client_id'),
                $request->get('client_secret')
            );

        if ($user) {
            $user->load([
                'tokens' => function($query) {
                    $query->whereRevoked(false);
                },
            ]);

            /* @var $token Token */
            $token = $user->tokens->first();

            if ($token) {
                $user->withAccessToken($token);

                if ($user->tokenCan($this->scope)) {
                    return $this->json([
                        'token'         => $token->getKey(),
                        'token_type'    => 'Bearer'
                    ], 'Auth token');
                }
            }
        }

        return $this->unauthorized();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function logout(Request $request) : JsonResponse
    {
        /* @var $user User */
        $user = $request->user();
        /* @var $token Token */
        $token = $user->token();
        $token->revoke();

        /* @var $client Client */
        /* //logout each device
        $client = $token->client();
        $clietTokens = $client->tokens()->whereRevoked(false)->get();
        foreach ($clietTokens as $token) {
            $token->revoke();
        }
        $client->revoked = true;
        $client->save();
        */

        return $this->json([], 'Logged out');
    }
}