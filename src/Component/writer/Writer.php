<?php


namespace App\Component\writer;

use App\Component\HandleErrorFormTrait;
use App\Component\retrieveAll\PartnerRetriever;
use App\Component\viewer\PartnerViewer;
use App\Entity\Partner;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;

class Writer
{
    use handleErrorFormTrait;

    /** @var ObjectManager  */
    private $manager;

    /** @var PartnerRetriever  */
    private $retriever;

    /** @var FormFactoryInterface  */
    private $formFactory;

    /** @var PartnerViewer  */
    private $viewer;

    public function __construct(
        ObjectManager $manager,
        PartnerRetriever $retriever,
        FormFactoryInterface $formFactory,
        PartnerViewer $viewer
    ) {
        $this->manager = $manager;
        $this->retriever = $retriever;
        $this->formFactory = $formFactory;
        $this->viewer = $viewer;
    }

    /**
     * @param int $id
     * @return array
     */
    public function deletePartner(int $id): array
    {
        /** @var  Partner */
        $partner =  $this->retriever->getOne($id);

        $partner->setIsActive(false);

        $this->save($partner, false);

        if (false === $this->retriever->getOne($id)->isActive()) {
            return [Response::HTTP_OK];
        }

        return [Response::HTTP_BAD_REQUEST];
    }

    /**
     * @param Partner $partner
     * @param bool $persist
     * @return array
     *
     */
    public function save(Partner $partner, bool $persist = true)
    {
        if (true === $persist) {
            $this->manager->persist($partner);
        }

        $this->manager->flush();

        return [Response::HTTP_OK];
    }
}
