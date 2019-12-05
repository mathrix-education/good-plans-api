<?php

declare(strict_types=1);

namespace App\Registrars;

use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

class AuthRegistrar extends BaseRegistrar
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $controller = AuthController::class;
        $this->post('auth/login', '');
    }
}
