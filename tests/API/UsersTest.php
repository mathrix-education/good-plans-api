<?php


namespace Tests\API;


use Mathrix\Lumen\Zero\Testing\Traits\CRUDAuto;
use Tests\APIStatelessTestCase;

class UsersTest extends APIStatelessTestCase
{
    use CRUDAuto;

    protected $exceptFactoryFields = ["birthdate", "created_at", "updated_at", "universities"];

    protected  $testKeys = [
        "list",
        "create",
        "read",
        "update",
        "delete",
    ];
}
