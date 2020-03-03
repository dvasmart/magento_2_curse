<?php

namespace Vitalii\Test\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Test\Api\Data\CarCustomerInterface;

/**
 * Interface CarCustomerRepositoryInterface
 */
interface CarCustomerRepositoryInterface
{
    /**
     * Save Car Customer entity
     *
     * @param CarCustomerInterface $carCustomer
     * @return CarCustomerInterface
     * @throws CouldNotSaveException
     */
    public function save(CarCustomerInterface $carCustomer): CarCustomerInterface;

    /**
     * Get Car Customer by its id
     *
     * @param int $carCustomerId
     * @return CarCustomerInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $carCustomerId): CarCustomerInterface;

    /**
     * Get Car Customer entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Car Customer entity
     *
     * @param CarCustomerInterface $carCustomer
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(CarCustomerInterface $carCustomer): bool;

    /**
     * Delete Car Customer entity by id
     *
     * @param int $carCustomerId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $carCustomerId): bool;
}
