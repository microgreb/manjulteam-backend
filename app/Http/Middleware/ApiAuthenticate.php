<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\BackStore\BaseController;
use App\Services\Users\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Laravel\Passport\Passport;

class ApiAuthenticate extends Middleware
{
    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        /* @var $contoller BaseController */
        $contoller = $request->route()->controller;

        /* @var $service AuthService */
        $service = resolve(AuthService::class);
        if ($user = $service->getUserByOauthToken($request->bearerToken())) {
            Passport::actingAs($user, $contoller->scopes);
        } else {
            throw new AuthenticationException();
        }
    }
}
