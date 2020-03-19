<?php

namespace Vitalii\Test\Block;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vitalii\Test\Api\Data\CarCustomerInterface;
use Vitalii\Test\Api\CarCustomerRepositoryInterface;
use Vitalii\Test\Api\Data\CarInterface;

/**
 * Class CarCustomers
 */
class CarCustomers extends Template
{
    const CARS_ACTION_ROUTE = 'my_route/customer/cars';

    /**
     * @var CarCustomerInterface[]|null
     */
    private $carCustomers;

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
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CarCustomerRepositoryInterface $carCustomerRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CarCustomerRepositoryInterface $carCustomerRepository,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->carCustomerRepository = $carCustomerRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * {@inheritDoc}
     */
    protected function _prepareLayout()
    {
        if ($this->carCustomers === null) {
            $this->carCustomers = [];
            try {
                /** @var SortOrder $sortOrder */
                $sortOrder = $this->sortOrderBuilder
                    ->setField(CarCustomerInterface::CREATED_AT)
                    ->setDirection(SortOrder::SORT_ASC)
                    ->create();
                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addSortOrder($sortOrder)
                    ->create();
                /** @var SearchResultsInterface $searchResults */
                $searchResults = $this->carCustomerRepository->getList($searchCriteria);
                if ($searchResults->getTotalCount() > 0) {
                    $this->carCustomers = $searchResults->getItems();
                }
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
                $text = 'Customers loading has failed: message "%s"';
                $message = sprintf($text, $error);
                $this->_logger->debug($message);
            }
        }

        return parent::_prepareLayout();
    }

    /**
     * @return CarCustomerInterface[]|null
     */
    public function getCarCustomers()
    {
        return $this->carCustomers;
    }


    /**
     * @param string|int $userId
     * @return string
     */
    public function getCarsUrl($userId)
    {
        return $this->getUrl(
            self::CARS_ACTION_ROUTE,
            [
                CarInterface::USER_ID => $userId
            ]
        );
    }
}
