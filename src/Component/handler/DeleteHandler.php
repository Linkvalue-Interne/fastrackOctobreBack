<?php


namespace App\Component\handler;

use App\Component\retrieveAll\PartnerRetriever;
use App\Component\writer\Writer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteHandler implements HandlerInterface
{
    /** @var Writer  */
    private $writer;

    /** @var PartnerRetriever  */
    private $partnerRetriever;

    public function __construct(Writer $writer, PartnerRetriever $retriever)
    {
        $this->writer = $writer;
        $this->partnerRetriever = $retriever;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array
    {
        $PartnerId  = $request->get('id');

        if ($this->partnerRetriever->getOne($PartnerId)) {
            return $this->writer->deletePartner($PartnerId);
        }

        return [Response::HTTP_BAD_REQUEST];
    }
}
