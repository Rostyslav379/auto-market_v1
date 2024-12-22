<?php

namespace App\Repository;

use App\Document\Model;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\UnitOfWork;

class ModelRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm, UnitOfWork $uow)
    {
        parent::__construct($dm, $uow, new ClassMetadata(Model::class));
    }

    public function findModelById(string $id): Model
    {
        return  $this->findOneBy(['id' => $id]);
    }

    /**
     * @return Model[]
     */
    public function finAllModels(): array
    {
        return $this->findAll();
    }
}