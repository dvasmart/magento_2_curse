<?php

namespace Vitalii\Test\Api;

/**
 * Interface CarsServiceInterface
 */
interface CarsServiceInterface
{
    /**
     * @return mixed
     */
    public function getCarsList();

    /**
     * @param int $userId
     * @return mixed
     */
    public function getCarsListByUserId($userId);

    /**
     * @param Data\CarInterface $car
     * @return mixed
     */
    public function saveOrUpdate(Data\CarInterface $car);

    /**
     * @param int $carId
     * @return mixed
     */
    public function deleteById(int $carId);
}
