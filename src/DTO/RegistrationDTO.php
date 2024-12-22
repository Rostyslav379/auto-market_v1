<?php

namespace App\DTO;

class RegistrationDTO
{
    public function __construct(
        private readonly string $email,
        private readonly string $username,
        private readonly string $password,
        private readonly string $phone
    )
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }


}