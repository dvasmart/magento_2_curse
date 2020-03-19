<?php

namespace Vitalii\Test\Model;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Vitalii\Test\Api\CarCustomerRepositoryInterface;
use Vitalii\Test\Api\CustomersServiceInterface;
use Vitalii\Test\Api\Data\CarCustomerInterface;

/**
 * Class CustomersService
 */
class CustomersService implements CustomersServiceInterface
{
    /**
     * @var CarCustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param CarCustomerRepositoryInterface $customerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CarCustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function getCustomersList()
    {
        $resultArray = [];
        try {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder->create();
            /** @var SearchResultsInterface $searchResults */
            $searchResults = $this->customerRepository->getList($searchCriteria);
            if ($searchResults->getTotalCount() > 0) {
                foreach ($searchResults->getItems() as $item) {
                    /** @var CarCustomerInterface $item */
                    $resultArray[] = [
                        'id' => $item->getId(),
                        'email' => $item->getEmail(),
                        'some_id' => $item->getSomeId(),
                        'name' => $item->getName(),
                        'created_at' => $item->getCreatedAt()
                    ];
                }
            }
        } catch (\Exception $exception) {
            // logging
        }

        return $resultArray;
    }

    /**
     * @inheritdoc
     */
    public function getCustomerById($customerId)
    {
        $resultArray = [];
        if (empty($customerId)) {
            return $resultArray;
        }

        try {
            /** @var CarCustomerInterface $searchResults */
            $item = $this->customerRepository->getById($customerId);
            if ($item->getId()) {
                /** @var CarCustomerInterface $item */
                $resultArray[] = [
                    'id' => $item->getId(),
                    'email' => $item->getEmail(),
                    'some_id' => $item->getSomeId(),
                    'name' => $item->getName(),
                    'created_at' => $item->getCreatedAt()
                ];
            }
        } catch (\Exception $exception) {
            // logging
        }

        return $resultArray;
    }

    /**
     * {@inheritDoc}
     */
    public function saveOrUpdate(CarCustomerInterface $customer)
    {
        try {
            $newCustomer = $this->customerRepository->save($customer);
            if ($customer->getId() > 0) {
                $message = sprintf('Success, customer has been found and updated, id is: %s', $newCustomer->getId());
            } else {
                $message = sprintf('Success, new customer has been created, id is: %s', $newCustomer->getId());
            }
        } catch (\Exception $exception) {
            $message = sprintf('Could not save customer: %s', $exception->getMessage());
        }

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $customerId)
    {
        try {
            $this->customerRepository->deleteById($customerId);
            $message = sprintf('Success, the customer with id "%s" has been deleted!', $customerId);
        } catch (\Exception $exception) {
            $exceptionMessage = $exception->getMessage();
            $message = sprintf('Could not delete customer with id: %s; message: %s', $customerId, $exceptionMessage);
        }

        return $message;
    }
}
