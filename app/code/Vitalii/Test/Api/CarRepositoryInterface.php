<?php

namespace Vitalii\Test\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Test\Api\Data\CarInterface;

/**
 * Interface CarRepositoryInterface
 */
interface CarRepositoryInterface
{
    /**
     * Save Car entity
     *
     * @param CarInterface $car
     * @return CarInterface
     * @throws CouldNotSaveException
     */
    public function save(CarInterface $car): CarInterface;

    /**
     * Get Car by its id
     *
     * @param int $carId
     * @return CarInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $carId): CarInterface;

    /**
     * Get Car entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Car entity
     *
     * @param CarInterface $car
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(CarInterface $car): bool;

    /**
     * Delete Car entity by id
     *
     * @param int $carId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $carId): bool;
}
