<?php

namespace Vitalii\Test\Block;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vitalii\Test\Api\Data\CarCustomerInterface;
use Vitalii\Test\Api\CarCustomerRepositoryInterface;
use Vitalii\Test\Model\CarCustomerModel;
use Vitalii\Test\Model\ResourceModel\CarCustomer\Collection as CarCustomerCollection;
use Vitalii\Test\Model\ResourceModel\CarCustomer\CollectionFactory as CarCustomerCollectionFactory;

/**
 * Class CarCustomers
 */
class CarCustomers extends Template
{
    /**
     * @var CarCustomerCollectionFactory
     */
    private $carCustomersCollectionFactory;

    /**
     * @var CarCustomerCollection|null
     */
    private $carCustomersCollection;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var CarCustomerRepositoryInterface
     */
    private $carCustomerRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param Context $context
     * @param CarCustomerCollectionFactory $carCustomersCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CarCustomerRepositoryInterface $carCustomerRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        CarCustomerCollectionFactory $carCustomersCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CarCustomerRepositoryInterface $carCustomerRepository,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
    parent::__construct($context, $data);
        $this->carCustomersCollectionFactory = $carCustomersCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->carCustomerRepository = $carCustomerRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        if ($this->carCustomersCollection === null) {
            /** @var SortOrder $sortOrder */
            $sortOrder = $this->sortOrderBuilder
                ->setField(CarCustomerInterface::CREATED_AT)
                ->setDirection(SortOrder::SORT_ASC)
                ->create();

            /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addSortOrder($sortOrder)
                ->create();

            /** @var SearchResults $searchResults */
            $searchResults = $this->carCustomerRepository->getList($searchCriteria);

//            $this->carCustomerRepository->deleteById(2);
            if ($searchResults->getTotalCount() > 0) {
                $this->carCustomersCollection = $searchResults->getItems();
            }
        }

        return parent::_prepareLayout();
    }
    /**
     * @return CarCustomerCollection|null
     */
    public function getCarCustomersCollection()
    {
        return $this->carCustomersCollection;
    }
}
