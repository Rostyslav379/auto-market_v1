<?php

namespace App\DTO;

class CreateMarkDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $country)
    {
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