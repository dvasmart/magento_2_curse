<?php

namespace Vitalii\Exam\Model;

use Magento\Framework\Api\SearchResults;

/**
 * Рекомендації:
 *
 * Всі класи/інтерфейси в use повинні бути відсортованими по алфавіту.
 * Всі невикористовувані в коді класи повинні бути видаленими з use.
 */
use Magento\Framework\Api\SearchResultsInterface;

use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Exam\Api\FruitRepositoryInterface;
use Vitalii\Exam\Api\Data\FruitInterface;
use Vitalii\Exam\Model\FruitModelFactory;
use Vitalii\Exam\Model\ResourceModel\FruitResource\Collection;
use Vitalii\Exam\Model\ResourceModel\FruitResource\CollectionFactory as FruitCollectionFactory;
use Vitalii\Exam\Model\ResourceModel\FruitResource;

/**
 * Class FruitRepository
 */
class FruitRepository implements FruitRepositoryInterface
{
    /**
     * @var FruitModelFactory
     */
    private $fruitFactory;

    /**
     * @var FruitCollectionFactory
     */
    private $fruitCollectionFactory;

    /**
     * @var FruitResource
     */
    private $resource;

    /**
     * @type SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @type CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param FruitModelFactory $fruitFactory
     * @param FruitCollectionFactory $fruitCollectionFactory
     * @param FruitResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        FruitModelFactory $fruitFactory,
        FruitCollectionFactory $fruitCollectionFactory,
        FruitResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->fruitFactory = $fruitFactory;
        $this->fruitCollectionFactory = $fruitCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(FruitInterface $fruit): FruitInterface
    {
        try {
            /** @var FruitModel|FruitInterface $fruit */
            $this->resource->save($fruit);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $fruit;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $fruitId): FruitInterface
    {
        /** @var FruitModel|FruitInterface $fruit */
        $fruit = $this->fruitFactory->create();
        $fruit->load($fruitId);
        if (!$fruit->getId()) {
            throw new NoSuchEntityException(__('Fruit entity with id `%1` does not exist.', $fruitId));
        }

        return $fruit;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->fruitCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        /** @var SearchResults $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(FruitInterface $fruit): bool
    {
        try {
            /** @var FruitModel $fruit */
            $this->resource->delete($fruit);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $fruitId): bool
    {
        return $this->delete($this->getById($fruitId));
    }
}
