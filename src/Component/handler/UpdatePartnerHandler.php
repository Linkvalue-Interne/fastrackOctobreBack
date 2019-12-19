<?php


namespace App\Component\handler;

use App\Component\builder\PartnerBuilder;
use App\Component\transformer\PartnerSkillTransformer;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use Symfony\Component\HttpFoundation\Request;

class UpdatePartnerHandler implements HandlerInterface
{
    use FormatDataTrait;

    /** @var PartnerBuilder  */
    private $partnerBuilder;

    /** @var PartnerViewer  */
    private $partnerViewer;

    /** @var PartnerSkillTransformer  */
    private $partnerSkillTransformer;

    /** @var Writer  */
    private $writer;

    public function __construct(
        PartnerBuilder $partnerBuilder,
        PartnerViewer $partnerViewer,
        Writer $writer,
        PartnerSkillTransformer $partnerSkillTransformer
    ) {
        $this->partnerBuilder = $partnerBuilder;
        $this->partnerViewer = $partnerViewer;
        $this->writer = $writer;
        $this->partnerSkillTransformer = $partnerSkillTransformer;
    }

    /** {@inheritDoc} */
    public function handle(Request $request): array
    {
        $data = json_decode($request->getContent(), true);

        $partner = $this->writer
            ->savePartner($this->partnerBuilder
                ->buildWithForm(
                    $this->formatData($data),
                    $data['id']
                ));

        foreach ($this->partnerSkillTransformer->transformer($data) as $item) {
            $this->writer->savePartnerSkill($item);
        }

        return $this->partnerViewer->formatShow($partner);
    }
}
