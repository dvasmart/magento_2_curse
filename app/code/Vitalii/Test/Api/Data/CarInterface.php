<?php

namespace Vitalii\Test\Api\Data;

/**
 * Interface CarInterface
 */
interface CarInterface
{
    const ENTITY_ID = 'entity_id';

    const USER_ID = 'user_id';

    const CAR_ID = 'car_id';

    const DESCRIPTION = 'description';

    const CREATED_AT = 'created_at';

    const PRICE = 'price';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get car user id
     *
     * @return int
     */
    public function getUserId();

    /**
     * Get car id
     *
     * @return int
     */
    public function getCarId();

    /**
     * Get car description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get created at date
     *
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * Get car price
     *
     * @return float
     */
    public function getPrice();

    /**
     * Set entity id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set user id
     *
     * @param int $userId
     * @return CarInterface
     */
    public function setUserId(int $userId): CarInterface;

    /**
     * Set car id
     *
     * @param int $carId
     * @return CarInterface
     */
    public function setCarId(int $carId): CarInterface;

    /**
     * Set car description
     *
     * @param string $description
     * @return CarInterface
     */
    public function setDescription(string $description): CarInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return CarInterface
     */
    public function setCreatedAt(string $createdAt): CarInterface;

    /**
     * Set car price
     *
     * @param float $price
     * @return CarInterface
     */
    public function setPrice(float $price): CarInterface;
}
