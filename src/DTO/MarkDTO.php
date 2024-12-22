<?php

namespace App\DTO;

class MarkDTO
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $country
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

}