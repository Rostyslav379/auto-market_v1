<?php

namespace App\DTO;

class CarLIstItemDTO
{
    public function __construct(
        private readonly string $id,
        private readonly string $mark,
        private readonly string $model,
        private readonly string $releaseYear,
        private readonly string $image,
        private readonly int $race,
        private readonly int $cost,
        private readonly string $address
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMark(): string
    {
        return $this->mark;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getRace(): int
    {
        return $this->race;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getReleaseYear(): string
    {
        return $this->releaseYear;
    }

    public function getImage(): string
    {
        return $this->image;
    }

}