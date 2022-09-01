<?php
namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Dto\CreateTransactions;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

final class ValidateNumberCartSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['handlePreValidate', EventPriorities::PRE_VALIDATE],
            ],
        ];
    }

    public function handlePreValidate(ViewEvent $event): void
    {
        $dto = $event->getControllerResult();
        if ($dto instanceof CreateTransactions && $event->getRequest()->isMethod('POST')) {

            if (!$this->checkNumber($dto->fromCart) || !$this->checkNumber($dto->toCart)) {

            }
        }
    }

    private function checkNumber($number) {
        if (!is_numeric($number) || strlen($number) != 16) {
            return false;
        }
    }
}