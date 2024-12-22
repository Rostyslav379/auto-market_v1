<?php

namespace App\Service;

use App\Document\Mark;
use App\DTO\CreateMarkDTO;
use App\DTO\MarkDTO;
use App\Repository\MarkRepository;

class MarkService
{

    public function __construct(private readonly MarkRepository $markRepository)
    {
    }

    /**
     * @return MarkDTO[]
     */
    public function getAllMarks(): array
    {
        $dtos = [];
        foreach ($this->markRepository->finAllMarks() as $mark) {
            $dtos[] = new MarkDTO(
                id: $mark->getId(),
                name: $mark->getMark(),
                country: $mark->getCountry()
            );
        }
        return $dtos;
    }

    public function create(CreateMarkDTO $markDTO): void
    {
        $this->markRepository->save(new Mark($markDTO->getName(), $markDTO->getCountry()));
    }
}