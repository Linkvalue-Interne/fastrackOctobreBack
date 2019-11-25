<?php


namespace App\Component\handler;

use App\Component\builder\Builder;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array
    {
        $data = json_decode($request->getContent(), true);
        $form = $data['data']['form'];

        $keys = [
            'firstName',
            'lastName',
            'job',
            'email',
            'phoneNumber',
            'experience',
            'customer',
            'project',
        ];

        if (!array_diff_key(array_flip($keys), $form)) {
            return $this->viewer->formatShow($this->writer->savePartner($this->builder->buildWithForm($form)));
        }
        return ['statusCode' => Response::HTTP_BAD_REQUEST];
    }
}
