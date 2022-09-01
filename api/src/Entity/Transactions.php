<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransactionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionsRepository::class)]
#[ApiResource]
class Transactions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $payment;

    #[ORM\ManyToOne(targetEntity: CartNumber::class, inversedBy: 'transactionsFrom')]
    #[ORM\JoinColumn(nullable: false)]
    private $fromCart;

    #[ORM\ManyToOne(targetEntity: CartNumber::class, inversedBy: 'transactionsTo')]
    #[ORM\JoinColumn(nullable: false)]
    private $toCart;

    #[ORM\Column(type: 'integer')]
    private $fee;

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
}
