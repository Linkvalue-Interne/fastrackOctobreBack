<?php

namespace App\Controller;

use App\Component\handler\ListPartnerHandler;
use App\Component\handler\OnePartnerHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PartnerController
{
    /**
     * @param ListPartnerHandler $listHandler
     * @param Request $request
     * @return JsonResponse
     */
    public function list(ListPartnerHandler $listHandler, Request $request): JsonResponse
    {
        return new JsonResponse($listHandler->handle($request));
    }

    /**
     * @param OnePartnerHandler $onePartnerHandler
     * @param Request $request
     * @return JsonResponse
     */
    public function show(OnePartnerHandler $onePartnerHandler, Request $request): JsonResponse
    {
        return new JsonResponse($onePartnerHandler->handle($request));
    }
}
