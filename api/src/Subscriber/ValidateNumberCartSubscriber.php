<?php
namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Dto\CreateTransactions;
use Exception;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Core\Exception\InvalidArgumentException;

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

    }



}