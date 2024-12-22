<?php

namespace App\DTO;

class CarCreateUpdateDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $race,
        private readonly string $releaseYear,
        private readonly string $markId,
        private readonly string $modelId,
        private readonly string $cost,
        private readonly string $image,
        private readonly string $address,
        private readonly string $description,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRace(): string
    {
        return $this->race;
    }

    public function getReleaseYear(): string
    {
        return $this->releaseYear;
    }

    public function getMarkId(): string
    {
        return $this->markId;
    }

    public function getModelId(): string
    {
        return $this->modelId;
    }

    public function getCost(): string
    {
        return $this->cost;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }


}