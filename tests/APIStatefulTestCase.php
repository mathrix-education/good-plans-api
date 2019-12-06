<?php

namespace Tests;

use App\Mails\BaseMail;
use App\Models\User;
use cebe\openapi\spec\Operation;
use Illuminate\Support\Facades\Mail;
use Mathrix\Lumen\JWT\Auth\JWT;
use Mathrix\Lumen\Zero\Testing\Traits\CRUD;
use Mathrix\Lumen\Zero\Testing\Traits\Debuggable;
use Mathrix\OpenAPI\Assertions\Lumen\LumenOpenAPIAssertions;
use Throwable;

/**
 * Class APITestCase.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 5.0.0-rc1
 */
class APIStatefulTestCase extends BaseTestCase
{
    use CRUD, LumenOpenAPIAssertions, Debuggable;

    /** @var User $requester The request users */
    protected $requester;


    public static function setUpBeforeClass(): void
    {
        self::$openAPISpecificationPath = __DIR__ . "/../docs/output.yaml";
        parent::setUpBeforeClass();
    }


    public function setUp(): void
    {
        parent::setUp();

        $this->handler("before.json", function (string $method, string $uri) {
            $scopes = $this->getOpenAPIScopes($method, $uri);

            if (!empty($scopes)) {
                if (count($scopes) === 1 && $scopes[0] === "logged") {
                    // Authentication needed
                    $this->requester = User::random();
                    JWT::actingAs($this->requester);
                } else {
                    $this->requester = JWT::withScopes($scopes[0]);
                }
            }
        });
    }


    /**
     * Automatically mock the scope according to the OpenAPI documentation. This ensure that the documentation is up to
     * date with the current implementation.
     *
     * @param string $method
     * @param string $uri
     * @param string $security
     *
     * @return string[]|null
     */
    public function getOpenAPIScopes(string $method, string $uri, string $security = "bearer")
    {
        $method = strtolower($method);

        $openAPIUri = self::$reverseRouter->getUri($method, $uri);

        $paths = self::$schema->paths;

        if (!isset($paths[$openAPIUri])) {
            $this->fail("$openAPIUri PathItem does not exist in the OpenAPI specification.");
        }

        $pathItem = $paths[$openAPIUri];

        if (!isset($pathItem->{$method})) {
            $this->fail("$openAPIUri does not support $method method.");
        }

        /** @var Operation $operation */
        $operation = $pathItem->{$method};

        if (!isset($operation->security[0]) || !isset($operation->security[0]->{$security})) {
            return null;
        } else {
            return $operation->security[0]->{$security};
        }
    }


    public function onNotSuccessfulTest(Throwable $t): void
    {
        $this->debug();
        parent::onNotSuccessfulTest($t);
    }


    /**
     * Assert that a mailable has been sent to an users.
     *
     * @param string|BaseMail $mailClass
     * @param User $user
     */
    public function assertMailSentTo($mailClass, User $user)
    {
        Mail::assertSent($mailClass, function ($mail) use ($user) {
            /** @var BaseMail $mail */
            return $mail->hasTo($user->email);
        });
    }
}
