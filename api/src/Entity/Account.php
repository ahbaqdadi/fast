<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AcountRepository::class)]
#[ApiResource]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $number;

    #[ORM\Column(type: 'integer')]
    private $money;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: false)]
    private $userAccount;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: CartNumber::class)]
    private $cartNumbers;

    public function __construct()
    {
        $this->cartNumbers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getMoney(): ?int
    {
        return $this->money;
    }

    public function setMoney(int $money): self
    {
        $this->money = $money;

        return $this;
    }

    public function getUserAccount(): ?User
    {
        return $this->userAccount;
    }

    public function setUserAccount(?User $userAccount): self
    {
        $this->userAccount = $userAccount;

        return $this;
    }

    /**
     * @return Collection|CartNumber[]
     */
    public function getCartNumbers(): Collection
    {
        return $this->cartNumbers;
    }

    public function addCartNumber(CartNumber $cartNumber): self
    {
        if (!$this->cartNumbers->contains($cartNumber)) {
            $this->cartNumbers[] = $cartNumber;
            $cartNumber->setAccount($this);
        }

        return $this;
    }

    public function removeCartNumber(CartNumber $cartNumber): self
    {
        if ($this->cartNumbers->removeElement($cartNumber)) {
            // set the owning side to null (unless already changed)
            if ($cartNumber->getAccount() === $this) {
                $cartNumber->setAccount(null);
            }
        }

        return $this;
    }
}
