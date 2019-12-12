<?php

namespace App\Controller;

use App\Component\handler\CreatePartnerHandler;
use App\Component\handler\DeletePartnerHandler;
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

    /**
     * @param DeletePartnerHandler $deleteHandler
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(DeletePartnerHandler $deleteHandler, Request $request): JsonResponse
    {
        return new JsonResponse($deleteHandler->handle($request));
    }

    /**
     * @param CreatePartnerHandler $createHandler
     * @param Request $request
     * @return JsonResponse
     */
    public function create(CreatePartnerHandler $createHandler, Request $request): JsonResponse
    {
        return new JsonResponse($createHandler->handle($request));
    }
}
