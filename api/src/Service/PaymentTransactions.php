<?php 

namespace App\Service;

use App\Dto\CreateTransactions;
use App\Entity\Account;
use App\Entity\Transactions as TransactionsEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;


final class PaymentTransactions
{
    public function __construct(
        private ValidateCartNumber $validateCartNumber,
        private EntityManagerInterface $entityManager
        )
    {
        
    }

    public function execute(CreateTransactions $transaction)
    {
        $fromNumberValidated = $this->validateCartNumber->validate($transaction->fromCart);
        $toNumberValidated = $this->validateCartNumber->validate($transaction->toCart);
        $accountMoney = $fromNumberValidated->getAccount()->getMoney();

        if (
            $this->checkMoney($accountMoney, $transaction->money) != false &&
            $fromNumberValidated != null && $fromNumberValidated != null &&
            $fromNumberValidated != $toNumberValidated
           ) 
           {
            try {
                $fromNumberValidated->getAccount()->setMoney($accountMoney - $transaction->money);
                $toNumberValidated->getAccount()->setMoney($toNumberValidated->getAccount()->getMoney() + $transaction->money);
                $this->entityManager->flush();
                $transactionEntity = $this->createTrasactionObject(
                    "Success !",
                    "All system Data Added !",
                    $transaction,
                    $fromNumberValidated,
                    $toNumberValidated
                );

                $this->entityManager->persist($transactionEntity);
                $this->entityManager->flush();
            } catch (OptimisticLockException $e) {
                dump("Sorry, but someone else has already changed this entity. Please apply the changes again!");
            }
        } else {
            $transactionEntity = $this->createTrasactionObject(
                "failed !",
                "invalid arguman !",
                $transaction,
                $fromNumberValidated,
                $toNumberValidated
            );
            $this->entityManager->persist($transactionEntity);
            $this->entityManager->flush();
        }
    }

    private function checkMoney($accountMoney, $money)
    {
        if ($accountMoney <= $money) {
            return false;
        }

        return true;
    }

    private function createTrasactionObject(string $status, string $message, CreateTransactions $transaction, $fromNumberValidated, $toNumberValidated)
    {
        $transactionEntity = new TransactionsEntity();
        $transactionEntity->setPayment($transaction->money);
        $transactionEntity->setFromCart($fromNumberValidated ? $fromNumberValidated : null);
        $transactionEntity->setToCart($toNumberValidated ? $toNumberValidated : null);
        $transactionEntity->setUuid($transaction->uuid);
        $transactionEntity->setStatus($status);
        $transactionEntity->setMessages($message);
        return $transactionEntity;
    }
}