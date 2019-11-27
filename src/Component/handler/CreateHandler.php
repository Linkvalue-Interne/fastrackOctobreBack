<?php


namespace App\Component\handler;

use App\Component\builder\Builder;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use App\CustomException\FormRequiredException;
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

    /**
     * @param Request $request
     * @return array
     * @throws FormRequiredException
     */
    public function handle(Request $request): array
    {
        $data = json_decode($request->getContent(), true);

        $keys = [
            'firstName',
            'lastName',
            'job',
            'email',
            'phoneNumber',
            'experience',
            'customer',
        ];

        $arrayDiff = array_diff_key(array_flip($keys), $data);

        if (isset($data['customer'])) {
            if ('booster' == $data['customer'] && empty($data['project'])) {
                $arrayDiff ['project'] = 'project';
            }
        }

        if (!empty($arrayDiff)) {
            throw new FormRequiredException($arrayDiff);
        }

        return $this->viewer->formatShow($this->writer->savePartner($this->builder->buildWithForm($data)));
    }
}
