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
use Vitalii\Test\Api\CarCustomerRepositoryInterface;
use Vitalii\Test\Api\Data\CarCustomerInterface;
use Vitalii\Test\Model\CarCustomerModelFactory;
use Vitalii\Test\Model\ResourceModel\CarCustomer\Collection;
use Vitalii\Test\Model\ResourceModel\CarCustomer\CollectionFactory as CarCustomerCollectionFactory;
use Vitalii\Test\Model\ResourceModel\CarCustomer as CarCustomerResource;

/**
 * Class CarCustomerRepository
 */
class CarCustomerRepository implements CarCustomerRepositoryInterface
{
    /**
     * @var CarCustomerModelFactory
     */
    private $carCustomerFactory;

    /**
     * @var CarCustomerCollectionFactory
     */
    private $carCustomerCollectionFactory;

    /**
     * @var CarCustomerResource
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
     * @param CarCustomerModelFactory $carCustomerFactory
     * @param CarCustomerCollectionFactory $carCustomerCollectionFactory
     * @param CarCustomerResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        CarCustomerModelFactory $carCustomerFactory,
        CarCustomerCollectionFactory $carCustomerCollectionFactory,
        CarCustomerResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->carCustomerFactory = $carCustomerFactory;
        $this->carCustomerCollectionFactory = $carCustomerCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(CarCustomerInterface $carCustomer): CarCustomerInterface
    {
        try {
            /** @var CarCustomerModel|CarCustomerInterface $carCustomer */
            $this->resource->save($carCustomer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $carCustomer;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $carCustomerId): CarCustomerInterface
    {
        /** @var CarCustomerModel|CarCustomerInterface $carCustomer */
        $carCustomer = $this->carCustomerFactory->create();
        $carCustomer->load($carCustomerId);
        if (!$carCustomer->getId()) {
            throw new NoSuchEntityException(__('Car Customer entity with id `%1` does not exist.', $carCustomerId));
        }

        return $carCustomer;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->carCustomerCollectionFactory->create();
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
    public function delete(CarCustomerInterface $carCustomer): bool
    {
        try {
            /** @var CarCustomerModel $carCustomer */
            $this->resource->delete($carCustomer);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $carCustomerId): bool
    {
        return $this->delete($this->getById($carCustomerId));
    }
}
