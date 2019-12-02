<?php


namespace App\Component\handler;

use App\Component\builder\Builder;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use Assert\Assertion;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateHandler implements HandlerInterface
{
    /** @var Writer  */
    private $writer;

    /** @var PartnerViewer  */
    private $viewer;

    /** @var Builder  */
    private $builder;

    /** @var LoggerInterface  */
    private $logger;

    public function __construct(Writer $writer, PartnerViewer $viewer, Builder $builder, LoggerInterface $logger)
    {
        $this->writer = $writer;
        $this->viewer = $viewer;
        $this->builder = $builder;
        $this->logger = $logger;
    }

    public function handle(Request $request): array
    {
        $this->logger->debug('handle', [$request->getContent()]);
        $data = json_decode($request->getContent(), true);

        $this->checkKey($data);

        return $this->viewer->formatShow($this->writer->savePartner($this->builder->buildWithForm($data)));
    }

    public function checkKey(array $data)
    {
        $message = 'the element with key "%s" is required';

        Assertion::keyExists($data, 'firstName', $message);
        Assertion::keyExists($data, 'lastName', $message);
        Assertion::keyExists($data, 'job', $message);
        Assertion::keyExists($data, 'email', $message);
        Assertion::keyExists($data, 'phoneNumber', $message);
        Assertion::keyExists($data, 'experience', $message);
    }
}
