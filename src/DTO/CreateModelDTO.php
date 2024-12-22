<?php

namespace App\DTO;

class CreateModelDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $markId)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMarkId(): string
    {
        return $this->markId;
    }


}