<?php

namespace App\Document;
use App\Repository\ModelRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use MongoDB\BSON\ObjectId;

#[ODM\Document(repositoryClass: ModelRepository::class)]
class Model
{
    #[ODM\Id]
    private ObjectId|string $id;
    #[ODM\Field(type: 'string')]
    private string $model;
    #[ODM\ReferenceOne(storeAs: 'id',targetDocument: Mark::class)]
    private Mark $mark;

    /**
     * @param string $model
     * @param Mark $mark
     */
    public function __construct(string $model, Mark $mark)
    {
        $this->id = new ObjectId();
        $this->model = $model;
        $this->mark = $mark;
    }

    public function getId(): ObjectId|string
    {
        return $this->id;
    }

    public function setId(ObjectId $id): void
    {
        $this->id = $id;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getMark(): Mark
    {
        return $this->mark;
    }

    public function setMark(Mark $mark): void
    {
        $this->mark = $mark;
    }

}