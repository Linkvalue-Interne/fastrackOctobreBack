<?php


namespace App\Component\handler;

interface HandlerInterface
{
    /**
     * @return array
     */
    public function handle(): array;
}
