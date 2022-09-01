<?php
// api/src/Handler/PersonHandler.php

namespace App\Handler;

use App\Dto\CreateTransactions;
use App\Entity\Transactions;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateTransactionsHandler implements MessageHandlerInterface
{
    public function __invoke(CreateTransactions $transaction)
    {
        dump("hello world");
        // do something with the resource
    }
}