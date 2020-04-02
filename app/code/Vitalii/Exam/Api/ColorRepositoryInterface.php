<?php


namespace Vitalii\Exam\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Exam\Api\Data\ColorInterface;

/**
 * Interface ColorRepositoryInterface
 */
interface ColorRepositoryInterface
{
    /**
     * Save Color entity
     *
     * @param ColorInterface $color
     * @return ColorInterface
     * @throws CouldNotSaveException
     */
    public function save(ColorInterface $color): ColorInterface;

    /**
     * Get Color by its id
     *
     * @param int $colorId
     * @return ColorInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $colorId): ColorInterface;

    /**
     * Get Color entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Color entity
     *
     * @param ColorInterface $color
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(ColorInterface $color): bool;

    /**
     * Delete Color entity by id
     *
     * @param int $colorId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $colorId): bool;
}
