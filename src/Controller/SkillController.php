<?php


namespace App\Controller;

use App\Component\handler\ListSkillHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SkillController
{
    /**
     * @param ListSkillHandler $listSkillHandler
     * @param Request $request
     * @return JsonResponse
     */
    public function list(ListSkillHandler $listSkillHandler, Request $request): JsonResponse
    {
        return new JsonResponse($listSkillHandler->handle($request));
    }
}
