<?php


namespace Tests\API;


use Mathrix\Lumen\Zero\Testing\Traits\CRUDAuto;
use Tests\APIStatelessTestCase;

class PlansTest extends APIStatelessTestCase
{
    use CRUDAuto;

    protected $exceptFactoryFields = ["starting_at", "ending_at", "created_at", "updated_at", "filters", "categories", "cities"];

    protected  $testKeys = [
        "list",
        "create",
        "read",
        "update",
        "delete",
    ];
}
