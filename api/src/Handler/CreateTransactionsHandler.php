<?php
// api/src/Handler/PersonHandler.php

namespace App\Handler;

use App\Dto\CreateTransactions;
use App\Entity\Transactions;
use App\Service\PaymentTransactions;
use App\Service\ValidateCartNumber;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateTransactionsHandler implements MessageHandlerInterface
{
    public function __construct(private PaymentTransactions $paymentTransactions)
    {
        
    }

    public function __invoke(CreateTransactions $transaction)
    {          
        $this->paymentTransactions->execute($transaction);
    }
}