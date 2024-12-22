<?php

namespace App\DTO;

class CarDTO
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly int $race,
        private readonly int $releaseYear,
        private readonly string $mark,
        private readonly string $model,
        private readonly string $ownerName,
        private readonly string $ownerPhone,
        private readonly string $ownerId,
        private readonly int $cost,
        private readonly string $image,
        private readonly string $address,
        private readonly string $description,
        private readonly string $publicDate,
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

    public function getRace(): int
    {
        return $this->race;
    }

    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    public function getMark(): string
    {
        return $this->mark;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    public function getOwnerPhone(): string
    {
        return $this->ownerPhone;
    }

    public function getCost(): int
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

    public function getPublicDate(): string
    {
        return $this->publicDate;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

}