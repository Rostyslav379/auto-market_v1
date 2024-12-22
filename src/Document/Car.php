<?php

namespace App\Document;

use App\Repository\CarRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use MongoDB\BSON\ObjectId;
#[ODM\HasLifecycleCallbacks]
#[Document(repositoryClass: CarRepository::class)]
class Car
{
    #[ODM\Id]
    private ObjectId|string $id;
    #[ODM\Field(type: 'string')]
    private string $name;
    #[ODM\Field(type: 'integer')]
    private int $race;
    #[ODM\Field(type: 'integer')]
    private int $realiseYear;
    #[ODM\ReferenceOne(storeAs: 'id',targetDocument: Mark::class)]
    private Mark $mark;
    #[ODM\ReferenceOne(storeAs: 'id',targetDocument: Model::class)]
    private Model $model;
    #[ODM\ReferenceOne(storeAs: 'id',targetDocument: User::class)]
    private User $user;
    #[ODM\Field(type: 'integer')]
    private int $cost;
    #[ODM\Field(type: 'string')]
    private string $image;
    #[ODM\Field(type: 'string')]
    private string $address;
    #[ODM\Field(type: 'string')]
    private string $description;
    #[ODM\Field(type: 'date', nullable: false)]
    private \DateTimeImmutable|\DateTime $createdAt;

    public function __construct(
        string $name, int $race, int $realiseYear,
        Mark $mark, Model $model, User $user,
        int $cost, string $image, string $address,
        string $description,
    )
    {
        $this->id = new ObjectId();
        $this->name = $name;
        $this->race = $race;
        $this->realiseYear = $realiseYear;
        $this->mark = $mark;
        $this->model = $model;
        $this->user = $user;
        $this->cost = $cost;
        $this->image = $image;
        $this->address = $address;
        $this->description = $description;
    }

    public function getId(): ObjectId|string
    {
        return $this->id;
    }

    public function setId(ObjectId $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRace(): int
    {
        return $this->race;
    }

    public function setRace(int $race): void
    {
        $this->race = $race;
    }

    public function getRealiseYear(): int
    {
        return $this->realiseYear;
    }

    public function setRealiseYear(int $realiseYear): void
    {
        $this->realiseYear = $realiseYear;
    }

    public function getMark(): Mark
    {
        return $this->mark;
    }

    public function setMark(Mark $mark): void
    {
        $this->mark = $mark;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): \DateTimeImmutable|\DateTime
    {
        return $this->createdAt;
    }
    #[ODM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }


}