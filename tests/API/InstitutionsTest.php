<?php


namespace Tests\API;


use App\Models\Institution;
use Mathrix\Lumen\Zero\Exceptions\InvalidArgument;
use Mathrix\Lumen\Zero\Testing\Traits\CRUDAuto;
use Tests\APIStatelessTestCase;

class InstitutionsTest extends APIStatelessTestCase
{
    use CRUDAuto;

    protected $exceptFactoryFields = ["created_at", "updated_at"];

    protected  $testKeys = [
        "list",
        "create",
        "read",
        "update",
    ];

    /**
     * @throws InvalidArgument
     */

    public function testDelete(): void
    {
        $institution = Institution::random();
        $fallback = Institution::random(["id", "!=", $institution->id]);
        $institution->plans()->update(["institution_id" => $fallback->id]);

        $this->makeRequest("delete", null, null, [
            "conditions" => ["id", "=", $institution->id]
        ]);

    }
}
