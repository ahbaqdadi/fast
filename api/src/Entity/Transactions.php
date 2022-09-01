<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransactionsRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Dto\CreateTransactions;

#[ORM\Entity(repositoryClass: TransactionsRepository::class)]
#[ApiResource(
    itemOperations: [
        'get'
    ],
    collectionOperations: [
        'get',
        "create_transactions" => [
            "status" => 202,
            "messenger" => "input",
            "input" => CreateTransactions::class,
            "output" => false,
            "method" => "POST",
            "path" => "/transactions/create_transaction"
          ]
    ],
)]
class Transactions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $payment;

    #[ORM\ManyToOne(targetEntity: CartNumber::class, inversedBy: 'transactionsFrom')]
    #[ORM\JoinColumn(nullable: true)]
    private $fromCart;

    #[ORM\ManyToOne(targetEntity: CartNumber::class, inversedBy: 'transactionsTo')]
    #[ORM\JoinColumn(nullable: true)]
    private $toCart;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $fee;

    #[ORM\Column(type: 'string', length: 255)]
    private $uuid;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    #[ORM\Column(type: 'text', nullable: true)]
    private $messages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayment(): ?int
    {
        return $this->payment;
    }

    public function setPayment(int $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getFromCart(): ?CartNumber
    {
        return $this->fromCart;
    }

    public function setFromCart(?CartNumber $fromCart): self
    {
        $this->fromCart = $fromCart;

        return $this;
    }

    public function getToCart(): ?CartNumber
    {
        return $this->toCart;
    }

    public function setToCart(?CartNumber $toCart): self
    {
        $this->toCart = $toCart;

        return $this;
    }

    public function getFee(): ?int
    {
        return $this->fee;
    }

    public function setFee(int $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMessages(): ?string
    {
        return $this->messages;
    }

    public function setMessages(?string $messages): self
    {
        $this->messages = $messages;

        return $this;
    }
}
