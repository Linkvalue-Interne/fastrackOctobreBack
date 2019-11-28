<?php


namespace App\Component\handler;

use App\Component\builder\Builder;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use App\CustomException\InvalidArgumentException;
use Assert\Assert;
use Assert\Assertion;
use Symfony\Component\HttpFoundation\Request;

class CreateHandler implements HandlerInterface
{
    /** @var Writer  */
    private $writer;

    /** @var PartnerViewer  */
    private $viewer;

    /** @var Builder  */
    private $builder;

    public function __construct(Writer $writer, PartnerViewer $viewer, Builder $builder)
    {
        $this->writer = $writer;
        $this->viewer = $viewer;
        $this->builder = $builder;
    }

    public function handle(Request $request): array
    {
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
        Assertion::keyExists($data, 'customer', $message);

        if (isset($data['customer']) && 'booster' == $data['customer']) {
            Assertion::keyExists($data, 'project', $message);
        }
    }
}
