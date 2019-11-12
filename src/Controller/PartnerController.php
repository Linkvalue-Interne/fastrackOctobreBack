<?php

namespace App\Controller;

use App\Component\handler\PartnerHandler;
use Symfony\Component\HttpFoundation\JsonResponse;

class PartnerController
{
    /**
     * @param PartnerHandler $listHandler
     * @return JsonResponse
     */
    public function list(PartnerHandler $listHandler): JsonResponse
    {
        return new JsonResponse($listHandler->handle());
    }
}
