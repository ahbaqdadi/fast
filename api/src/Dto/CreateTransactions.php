<?php

namespace App\Dto;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Uuid;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateTransactions
{
    #[Assert\NotBlank]
    public string $fromCart;
    #[Assert\NotBlank]
    public string $toCart;
    #[Assert\NotBlank]
    public int $money;
    #[Assert\NotBlank]
    public string $uuid;
}