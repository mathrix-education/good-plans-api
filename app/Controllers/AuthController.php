<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Mails\PasswordForgottenMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Mathrix\Lumen\JWT\Auth\JWT\JWTIssuer;
use Mathrix\Lumen\JWT\Auth\Exceptions\InvalidCredentials;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Exceptions\Http\Http400BadRequest;
use Mathrix\Lumen\Zero\Exceptions\ValidationException;
use Mathrix\Lumen\Zero\Responses\DataResponse;
use Mathrix\Lumen\Zero\Exceptions\Validation;
use Mathrix\Lumen\Zero\Responses\SuccessJsonResponse;
use Ramsey\Uuid\Uuid;

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

    /**
     * POST /auth/forgot
     * Allow users to request a password reset.
     *
     * @param Request $request The Illuminate HTTP request.
     *
     * @return JsonResponse The reset email confirmation.
     *
     * @throws Http400BadRequest
     * @throws Exception
     */
    public function forgot(Request $request): JsonResponse
    {
        // Try to find the users with the given email
        /** @var User $user */
        $user = User::query()
            ->where('email', '=', $request->json('email'))
            ->firstOrFail();

        if ($user->provider === 'facebook') {
            throw new Http400BadRequest(null, 'Cannot reset password of a facebook account');
        }

        $user->token = Uuid::uuid4()->toString();
        $user->save();

        // Send the password forgotten mail
        Mail::to($user->email)
            ->sendNow(new PasswordForgottenMail($user));

        return new JsonResponse(
            [],
            ['message' => 'Reset email sent successfully']
        );
    }

    /**
     * POST /auth/reset/{token}
     * Reset the users password using its current token.
     *
     * @param Request $request The Illuminate HTTP request.
     * @param string  $token   The reset token.
     *
     * @return JsonResponse The users.
     *
     * @throws Exception
     */
    public function reset(Request $request, string $token): JsonResponse
    {
        $this->validate($request, ['password' => 'required']);

        // Try to find with the given token
        /** @var User $user */
        $user = User::query()
            ->where('token', '=', $token)
            ->firstOrFail();

        // Update password
        User::unguarded(static function () use ($user, $request): void {
            $user->update([
                'password' => $request->input('password'),
                'token'    => null, // Remove token
            ]);
        });

        return new JsonResponse($user->refresh());
    }
}
