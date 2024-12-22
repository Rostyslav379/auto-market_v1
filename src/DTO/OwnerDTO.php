<?php

namespace App\DTO;

class OwnerDTO
{
    public function __construct(
        private readonly string $id,
        private readonly string $username,
        private readonly string $registrationDate,
        private readonly string $phone,
        private readonly string $carCount
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCarCount(): string
    {
        return $this->carCount;
    }


}