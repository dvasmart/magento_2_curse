<?php

namespace Vitalii\Test\Model;

use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Test\Api\CarRepositoryInterface;
use Vitalii\Test\Api\Data\CarInterface;
use Vitalii\Test\Model\CarModelFactory;
use Vitalii\Test\Model\ResourceModel\CarResource\Collection;
use Vitalii\Test\Model\ResourceModel\CarResource\CollectionFactory as CarCollectionFactory;
use Vitalii\Test\Model\ResourceModel\CarResource;

/**
 * Class CarRepository
 */
class CarRepository implements CarRepositoryInterface
{
    /**
     * @var CarCustomerModelFactory
     */
    private $carFactory;

    /**
     * @var CarCollectionFactory
     */
    private $carCollectionFactory;

    /**
     * @var CarResource
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
     * @param CarModelFactory $carFactory
     * @param CarCollectionFactory $carCollectionFactory
     * @param CarResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        CarModelFactory $carFactory,
        CarCollectionFactory $carCollectionFactory,
        CarResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->carFactory = $carFactory;
        $this->carCollectionFactory = $carCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(CarInterface $car): CarInterface
    {
        try {
            /** @var CarModel|CarInterface $car */
            $this->resource->save($car);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $car;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $carId): CarInterface
    {
        /** @var CarModel|CarInterface $car */
        $car = $this->carFactory->create();
        $car->load($carId);
        if (!$car->getId()) {
            throw new NoSuchEntityException(__('Car entity with id `%1` does not exist.', $carId));
        }

        return $car;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->carCollectionFactory->create();
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
    public function delete(CarInterface $car): bool
    {
        try {
            /** @var CarModel $car */
            $this->resource->delete($car);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $carId): bool
    {
        return $this->delete($this->getById($carId));
    }
}
