<?php

namespace App\Document;
use App\Repository\MarkRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use MongoDB\BSON\ObjectId;


#[ODM\Document(repositoryClass: MarkRepository::class)]
class Mark
{
    #[ODM\Id]
    private ObjectId|string $id;
    #[ODM\Field(type: 'string')]
    private string $mark;
    #[ODM\Field(type: 'string')]
    private string $country;

    /**
     * @param string $mark
     * @param string $country
     */
    public function __construct( string $mark, string $country)
    {
        $this->id = new ObjectId();
        $this->mark = $mark;
        $this->country = $country;
    }

    public function getId(): ObjectId|string
    {
        return $this->id;
    }

    public function setId(ObjectId $id): void
    {
        $this->id = $id;
    }

    public function getMark(): string
    {
        return $this->mark;
    }

    public function setMark(string $mark): void
    {
        $this->mark = $mark;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

}