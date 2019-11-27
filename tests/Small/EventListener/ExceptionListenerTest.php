<?php


namespace App\Tests\Small\EventListener;

use App\CustomException\ValidatorException;
use App\EventListener\ExceptionListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListenerTest extends TestCase
{
    private $event;

    protected function setUp(): void
    {
        parent::setUp();
        $this->event = $this->createMock(ExceptionEvent::class);
    }

    public function init()
    {
        return new ExceptionListener();
    }

    public function testOnKernelExceptionValidatorException()
    {
        $message = 'this value is already used';

        $errors = [
            'status' => 400,
            'massage' => $message,
            ]
        ;

        $this->expectException(ValidatorException::class);
        $this->expectExceptionCode(400);
        $this->expectException($message);

        $this->event
            ->expects($this->once())
            ->method('getException')
            ->willReturn($this->getExpectedException());

        $this->event
            ->expects($this->once())
            ->method('getResponse')
            ->willReturn(new JsonResponse($errors));

        $actual = $this->init()->onKernelException($this->event);

        $this->assertSame();
    }

}
