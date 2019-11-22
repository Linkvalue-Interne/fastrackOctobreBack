<?php


namespace App\Tests\Small\Component;

use App\Component\Builder;
use App\Entity\Partner;
use App\form\PartnerType;
use Symfony\Component\Form\Test\TypeTestCase;

class PartnerTypeTest extends TypeTestCase
{
    public function init()
    {
        return new Builder($this->factory);
    }

    public function testPartnerType()
    {
        $formData = [
            'firstName' => 'Dark',
            'lastName' => 'Vador',
            'job' => 'Sith',
            'email' => 'dark.vador@link-value.fr',
            'phoneNumber' => '01 02 03 04 05',
            'experience' => 20,
            'customer' => 'Empire',
            'project' => 'Death Stars',
        ];

        $objectToCompare = $this->createMock(Partner::class);
        $objectTest = $this->createMock(Partner::class);

        $form = $this->factory->create(PartnerType::class, $objectToCompare);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($objectTest, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        $this->assertArrayHasKey('firstName', $children);
        $this->assertArrayHasKey('lastName', $children);
        $this->assertArrayHasKey('job', $children);
        $this->assertArrayHasKey('email', $children);
        $this->assertArrayHasKey('phoneNumber', $children);
        $this->assertArrayHasKey('experience', $children);
        $this->assertArrayHasKey('customer', $children);
        $this->assertArrayHasKey('project', $children);
    }
}
