<?php

namespace App\DTO;

class CarListDTO
{
    private readonly array $cars;

    /**
     * @param CarLIstItemDTO[] $cars
     */

    public function __construct(array $cars)
    {
        $this->cars = $cars;
    }

    public function getCars(): array
    {
        return $this->cars;
    }


}