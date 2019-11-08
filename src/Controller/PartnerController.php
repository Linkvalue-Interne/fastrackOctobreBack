<?php

namespace App\Controller;

use App\Component\handler\partnerHandler\ListHandler;
use Symfony\Component\HttpFoundation\JsonResponse;

class PartnerController
{
    /**
     * @param ListHandler $listHandler
     * @return JsonResponse
     */
    public function list(ListHandler $listHandler)
    {
        return new JsonResponse($listHandler->handle());
    }
}
