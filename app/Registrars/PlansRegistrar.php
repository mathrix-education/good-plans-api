<?php

declare(strict_types=1);

namespace App\Registrars;

use App\Controllers\PlansController;
use Mathrix\Lumen\Zero\Exceptions\InvalidArgument;
use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

class PlansRegistrar extends BaseRegistrar
{
    /**
     * @throws InvalidArgument
     */
    public function register(): void
    {
        $this->registerCRUDRoutes([
            'list'   => null,
            'create' => null,
            'read'   => null,
            'update' => null,
            'delete' => null,
        ]);

        $this->post('/plans/{planId}/rate', PlansController::class . '@rate');
    }
}
