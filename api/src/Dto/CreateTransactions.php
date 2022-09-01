<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateTransactions
{
    #[Assert\NotBlank]
    public string $fromCart;
    #[Assert\NotBlank]
    public string $toCart;
    #[Assert\NotBlank]
    public int $money;
}