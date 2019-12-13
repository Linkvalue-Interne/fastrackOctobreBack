<?php


namespace App\Tests\Small\Component\builder;

use App\Component\builder\PartnerBuilder;
use App\Repository\PartnerRepository;
use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PartnerBuilderTest extends KernelTestCase
{
    private $formFactory;

    private $skillRepository;

    private $partnerRepository;

    protected function setUp(): void
    {
        parent::setUp();
//        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        self::bootKernel();
        $this->formFactory = self::$kernel->getContainer()->get('form.factory');
        $this->skillRepository = self::$kernel->getContainer()->get(SkillRepository::class);
        $this->partnerRepository = self::$kernel->getContainer()->get(PartnerRepository::class);
    }

    public function init()
    {
        return new PartnerBuilder($this->formFactory, $this->skillRepository);
    }

    public function BuildEditPartner()
    {
        $repo = self::$kernel->getContainer()->get(PartnerRepository::class);
        $skillRepo = self::$kernel->getContainer()->get(SkillRepository::class);

        $partner = $repo->findOneById(1);
        $data = [
            [
                'id' => 82,
                'level' => 67,
            ],
            [
                'id' => 1,
                'level' => 35,
            ],
            [
                'id' => 2,
                'level' => 54,
            ],
            [
                'id' => 3,
                'level' => 13,
            ],
            [
                'id' => 13,
                'level' => 22,
            ],
        ];

        $partner =  $this->init()->buildWithForm($data, $partner);


        dd('ok');
    }
}
