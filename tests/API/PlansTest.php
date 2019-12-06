<?php

namespace Tests\API;

use App\Models\Plan;
use App\Models\User;
use Mathrix\Lumen\JWT\Auth\JWT;
use Mathrix\Lumen\Zero\Testing\Traits\CRUDAuto;
use Tests\APIStatelessTestCase;

class PlansTest extends APIStatelessTestCase
{
    use CRUDAuto;

    protected $exceptFactoryFields = ["starting_at", "ending_at", "created_at", "updated_at", "filters", "categories",
                                      "cities"];

    protected $testKeys = [
        "list",
        "create",
        "read",
        "update",
        "delete",
    ];

    public function testRate()
    {
        $planId = Plan::random()->id;
        $user   = User::random();

        JWT::actingAs($user);

        $this->json('post', "/plans/$planId/rate", [
            'value' => 3,
        ]);

        $this->assertInDatabase('ratings', ['plan_id' => $planId, 'user_id' => $user->id, 'value' => 3]);
    }
}
