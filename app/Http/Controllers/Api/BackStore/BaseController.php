<?php
/**
 * Created by PhpStorm.
 * User: krootik
 * Date: 17.12.2019
 * Time: 14:48
 */

namespace App\Http\Controllers\Api\BackStore;

use App\Http\Controllers\Controller;
use App\Services\Users\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    //todo vadilate requests
    //todo transactions

    protected $authService;

    public $scope = '*';
    public $scopes = [];

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->scopes = explode(':', $this->scope);
    }

    /**
     * @param array  $data
     * @param string $message
     * @param int    $code
     * @param array  $headers
     *
     * @return JsonResponse
     */
    public function json(array $data, string $message = 'success', int $code = Response::HTTP_OK, array $headers = []) : JsonResponse
    {
        return new JsonResponse($data + ['message' => $message], $code, $headers);
    }

    /**
     * @return JsonResponse
     */
    public function unauthorized() : JsonResponse
    {
        return $this->json([], 'Unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}