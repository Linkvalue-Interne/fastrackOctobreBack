<?php

namespace App\Component\handler;

use App\Component\builder\PartnerBuilder;
use App\Component\transformer\PartnerSkillTransformer;
use App\Component\viewer\PartnerViewer;
use App\Component\writer\Writer;
use App\CustomException\CountFavoriteSkillException;
use App\Entity\Partner;
use Symfony\Component\HttpFoundation\Request;

class UpdatePartnerHandler implements HandlerInterface
{
    use FormatDataTrait;

    /** @var PartnerBuilder  */
    private $builder;

    /** @var PartnerViewer  */
    private $viewer;

    /** @var PartnerSkillTransformer  */
    private $transformer;

    /** @var Writer  */
    private $writer;

    /**
     * UpdatePartnerHandler constructor.
     *
     * @param PartnerBuilder $builder
     * @param PartnerViewer $viewer
     * @param PartnerSkillTransformer $transformer
     * @param Writer $writer
     */
    public function __construct(
        PartnerBuilder $builder,
        PartnerViewer $viewer,
        PartnerSkillTransformer $transformer,
        Writer $writer
    ) {
        $this->builder = $builder;
        $this->viewer = $viewer;
        $this->transformer = $transformer;
        $this->writer = $writer;
    }


    /** {@inheritDoc}
     *
     * @throws CountFavoriteSkillException
     */
    public function handle(Request $request): array
    {
        $data = json_decode($request->getContent(), true);

        $authorizedKey = [
            'firstName',
            'lastName',
            'job',
            'email',
            'phoneNumber',
            'experience',
            'customer',
            'project',
            'avatar',
        ];

        /** Update basic field */
        $partner = $this->builder
                ->buildWithForm(
                    $this->formatData($data, $authorizedKey),
                    $data['id']
                );

        /**  Update skill */
        foreach ($this->transformer->partnerSkillTransformer($data) as $item) {
            $this->writer->savePartnerSkill($item);
        }

        /** Delete favorite skill */
        $delFavoriteSkillDiff = $this->diffFavoriteSkill($data, $partner, true);
        if (!empty($delFavoriteSkillDiff)) {
            foreach ($delFavoriteSkillDiff as $item) {
                $partner->removeFavorite($item);
            }
        }

        /** Add favorite skill */
        $addFavoriteSkillDiff = $this->diffFavoriteSkill($data, $partner);
        if (!empty($addFavoriteSkillDiff)) {
            foreach ($addFavoriteSkillDiff as $item) {
                if (count($partner->getFavorites()->toArray()) >= 3) {
                    throw new CountFavoriteSkillException('Favorites are full');
                }
                $partner->addFavorite($item);
            }
        }

        $this->writer->savePartner($partner);

        return $this->viewer->formatShow($partner);
    }

    /**
     * Returns an array containing the skills present or not in the Partner Favorites attribute
     *
     * @param array|null $array
     * @param Partner|null $partner
     * @param bool $inverse
     *
     * @return array
     */
    private function diffFavoriteSkill(?array $array, ?Partner $partner, bool $inverse = false): array
    {
        $partnerFavorites = $partner->getFavorites()->toArray();
        $favoriteTransformed = $this->transformer->favoriteSkillTransformer($array['favorites']);

        return array_udiff(
            !$inverse ?  $favoriteTransformed : $partnerFavorites,
            !$inverse ? $partnerFavorites : $favoriteTransformed,
            function ($skill_a, $skill_b) {
                return $skill_a->getId() - $skill_b->getId();
            }
        );
    }
}
