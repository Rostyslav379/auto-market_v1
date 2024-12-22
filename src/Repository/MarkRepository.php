<?php

namespace App\Repository;

use App\Document\Mark;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\UnitOfWork;

class MarkRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm, UnitOfWork $uow)
    {
        parent::__construct($dm, $uow, new ClassMetadata(Mark::class));
    }

    public function findMarkById(string $id): Mark
    {
        return  $this->findOneBy(['id' => $id]);
    }

    /**
     * @return Mark[]
     */
    public function finAllMarks(): array
    {
        return $this->findAll();
    }

    public function save(Mark $mark): void
    {
        $this->dm->persist($mark);
        $this->dm->flush();
    }

}