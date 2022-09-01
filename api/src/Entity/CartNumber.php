<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CartNumberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartNumberRepository::class)]
#[ApiResource]
class CartNumber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $number;

    #[ORM\ManyToOne(targetEntity: Account::class, inversedBy: 'cartNumbers')]
    #[ORM\JoinColumn(nullable: false)]
    private $account;

    #[ORM\OneToMany(mappedBy: 'fromCart', targetEntity: Transactions::class)]
    private $transactionsFrom;

    #[ORM\OneToMany(mappedBy: 'toCart', targetEntity: Transactions::class)]
    private $transactionsTo;

    public function __construct()
    {
        $this->transactionsFrom = new ArrayCollection();
        $this->transactionsTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return Collection|Transactions[]
     */
    public function getTransactionsFrom(): Collection
    {
        return $this->transactionsFrom;
    }

    public function addTransactionFrom(Transactions $transactionFrom): self
    {
        if (!$this->transactionsFrom->contains($transactionFrom)) {
            $this->transactionsFrom[] = $transactionFrom;
            $transactionFrom->setFromCart($this);
        }

        return $this;
    }

    public function removeTransactionFrom(Transactions $transactionFrom): self
    {
        if ($this->transactionsFrom->removeElement($transactionFrom)) {
            // set the owning side to null (unless already changed)
            if ($transactionFrom->getFromCart() === $this) {
                $transactionFrom->setFromCart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transactions[]
     */
    public function getTransactionsTo(): Collection
    {
        return $this->transactionsTo;
    }

    public function addTransactionTo(Transactions $transactionTo): self
    {
        if (!$this->transactionsTo->contains($transactionTo)) {
            $this->transactionsTo[] = $transactionTo;
            $transactionTo->setFromCart($this);
        }

        return $this;
    }

    public function removeTransactionTo(Transactions $transactionTo): self
    {
        if ($this->transactionsTo->removeElement($transactionTo)) {
            // set the owning side to null (unless already changed)
            if ($transactionTo->getFromCart() === $this) {
                $transactionTo->setFromCart(null);
            }
        }

        return $this;
    }
}
