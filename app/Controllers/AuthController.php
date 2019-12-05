<?php

declare(strict_types=1);

namespace App\Controllers;

use Mathrix\Lumen\Zero\Controllers\BaseController;

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
