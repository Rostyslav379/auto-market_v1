<?php

namespace App\Service;

use App\Document\Model;
use App\DTO\CreateModelDTO;
use App\DTO\ModelDTO;
use App\Repository\MarkRepository;
use App\Repository\ModelRepository;

class ModelService
{
    public function __construct(
        private readonly ModelRepository $modelRepository,
        private readonly MarkRepository $markRepository
    )
    {
    }

    /**
     * @return ModelDTO[]
     */
    public function getAllModels(): array
    {
        $dtos = [];
        foreach ($this->modelRepository->finAllModels() as $model) {
            $dtos[] = new ModelDTO(
                id: $model->getId(),
                name: $model->getModel(),
                markId: $model->getMark()->getId(),
                mark: $model->getMark()->getMark()
            );
        }
        return $dtos;
    }

    public function create(CreateModelDTO $modelDTO): void
    {
        $mark = $this->markRepository->findMarkById($modelDTO->getMarkId());
        $this->markRepository->getDocumentManager()->persist(new Model($modelDTO->getName(),$mark));
        $this->markRepository->getDocumentManager()->flush();
    }
}