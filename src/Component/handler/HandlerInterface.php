<?php


namespace App\Component\handler;

use Symfony\Component\HttpFoundation\Request;

interface HandlerInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array;
}
