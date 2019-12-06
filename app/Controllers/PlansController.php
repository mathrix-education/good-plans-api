<?php

namespace App\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Responses\DataResponse;

class PlansController extends BaseController
{
    /**
     * POST /plans/{planId}/rate
     * Rate a plan.
     *
     * @param Request $request The Illuminate HTTP Request.
     * @param int     $planId  The plan id.
     *
     * @return DataResponse
     */
    public function rate(Request $request, int $planId)
    {
        $rating          = new Rating();
        $rating->plan_id = $planId;
        $rating->value   = $request->json('value');
        $rating->user_id = $request->user()->id;
        $rating->save();

        return new DataResponse($rating);
    }
}
