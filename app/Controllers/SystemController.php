<?php

declare(strict_types=1);

namespace App\Controllers;

use Illuminate\Http\Response;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use function file_get_contents;
use function resource_path;

/**
 * Allow control of system services.
 */
class SystemController extends BaseController
{
    /**
     * GET /
     * Display the Redoc generated documentation.
     */
    public function base(): Response
    {
        $docs = file_get_contents(resource_path('views/docs/index.html'));

        return new Response($docs);
    }
}
