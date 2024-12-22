<?php

namespace App\DTO;

class ModelDTO
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $markId,
        private readonly string $mark,
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

    public function getMarkId(): string
    {
        return $this->markId;
    }

    public function getMark(): string
    {
        return $this->mark;
    }

}