<?php


namespace App\Component\handler;

use App\Component\retrieveAll\PartnerRetriever;
use App\Component\writer\Writer;
use App\CustomException\InvalidArgumentException;
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
        $partner = $this->partnerRetriever->getOne($request->get('id'));

        if (!$partner) {
            throw new InvalidArgumentException();
        }

        $this->writer->savePartner($partner->setIsactive(false));

        return ['statusCode' => Response::HTTP_OK];
    }
}
