<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mathrix\Lumen\JWT\Auth\Exceptions\InvalidCredentials;
use Mathrix\Lumen\JWT\Auth\JWT\JWTIssuer;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Exceptions\Validation;
use Mathrix\Lumen\Zero\Responses\DataResponse;

class AuthController extends BaseController
{
    /**
     * POST /auth/login
     *
     * @param Request $request The Illuminate HTTP request.
     *
     * @return DataResponse
     *
     * @throws InvalidCredentials
     * @throws Validation
     * @throws Exception
     */
    public function login(Request $request): DataResponse
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        /** @var User $user */
        $user = User::query()
            ->where('email', '=', $request->json('email'))
            ->get(['id', 'password', 'scopes'])
            ->first();

        if ($user === null) {
            throw new InvalidCredentials();
        }

        $logged = Hash::check((string)$request->json('password'), $user->password);

        if (!$logged) {
            throw new InvalidCredentials();
        }

        $jws   = app()->make(JWTIssuer::class)->issueJWS($user);
        $token = app()->make(JWTIssuer::class)->serializeJWS($jws);

        return new DataResponse(['token' => $token]);
    }
}
