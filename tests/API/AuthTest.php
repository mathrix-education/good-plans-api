<?php

namespace Tests\API;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\APIStatelessTestCase;

class AuthTest extends APIStatelessTestCase
{
    /**
     * POST /auth/login
     */
    public function testLogin(): void
    {
        $user           = User::random();
        $oldHash        = $user->password; // Save the current hash for revert after the test
        $password       = $this->faker->password;
        $user->password = Hash::make($password);
        $user->save();

        $this->json("post", "/auth/login", [
            "email"    => $user->email,
            "password" => $password,
        ]);

        $this->assertResponseOk();
        $this->assertOpenAPIResponse($this->response);

        // Revert password change
        DB::table("users")
            ->where("id", "=", $user->id)
            ->update(["password" => $oldHash]);
    }

    /**
     * POST /auth/login
     */
    public function testLoginFailed()
    {
        $user = User::random();

        $this->json("post", "/auth/login", [
            "email"    => $user->email,
            "password" => "incorrect-password",
        ]);

        $this->assertResponseStatus(401);
    }
}
