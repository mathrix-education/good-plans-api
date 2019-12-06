<?php

declare(strict_types=1);

namespace App\Registrars;

use App\Controllers\AuthController;
use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

class AuthRegistrar extends BaseRegistrar
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $controller = AuthController::class;
        $this->post('auth/login', "$controller@login");
        $this->post('auth/forgot', "$controller@forgot");
    }
}
