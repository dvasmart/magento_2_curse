<?php

namespace Vitalii\Exam\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Exam\Api\Data\FruitInterface;

/**
 * Interface FruitRepositoryInterface
 */
interface FruitRepositoryInterface
{
    /**
     * Save Fruit entity
     *
     * @param FruitInterface $fruit
     * @return FruitInterface
     * @throws CouldNotSaveException
     */
    public function save(FruitInterface $fruit): FruitInterface;

    /**
     * Get Fruit by its id
     *
     * @param int $fruitId
     * @return FruitInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $fruitId): FruitInterface;

    /**
     * Get Car entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Fruit entity
     *
     * @param FruitInterface $fruit
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(FruitInterface $fruit): bool;

    /**
     * Delete Fruit entity by id
     *
     * @param int $fruitId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $fruitId): bool;
}
