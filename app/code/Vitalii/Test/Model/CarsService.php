<?php

namespace Vitalii\Test\Model;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Vitalii\Test\Api\CarRepositoryInterface;
use Vitalii\Test\Api\CarsServiceInterface;
use Vitalii\Test\Api\Data\CarInterface;

/**
 * Class CarsService
 */
class CarsService implements CarsServiceInterface
{
    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param CarRepositoryInterface $carRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CarRepositoryInterface $carRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->carRepository = $carRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param int|null $userId
     * @return SearchCriteria
     */
    private function getSearchCriteria($userId = null)
    {
        if ($userId > 0) {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(CarInterface::USER_ID, $userId)
                ->create();
        } else {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder->create();
        }

        return $searchCriteria;
    }

    /**
     * @param int|null $userId
     * @return array
     */
    private function composeList($userId = null)
    {
        $resultArray = [];
        try {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->getSearchCriteria($userId);
            /** @var SearchResultsInterface $searchResults */
            $searchResults = $this->carRepository->getList($searchCriteria);
            if ($searchResults->getTotalCount() > 0) {
                foreach ($searchResults->getItems() as $item) {
                    /** @var CarInterface $item */
                    $resultArray[] = [
                        'id' => $item->getId(),
                        'car_id' => $item->getCarId(),
                        'description' => $item->getDescription(),
                        'user_id' => $item->getUserId(),
                        'created_at' => $item->getCreatedAt(),
                        'price' => $item->getPrice()
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
    public function getCarsList()
    {
        return $this->composeList();
    }

    /**
     * @inheritdoc
     */
    public function getCarsListByUserId($userId)
    {
        if (empty($userId)) {
            return [];
        }

        return $this->composeList($userId);
    }

    /**
     * {@inheritDoc}
     */
    public function saveOrUpdate(CarInterface $car)
    {
        try {
            $newCar = $this->carRepository->save($car);
            $message = sprintf('success, new car id is: %s', $newCar->getId());
        } catch (\Exception $exception) {
            $message = sprintf('could not save: %s', $exception->getMessage());
        }

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $carId)
    {
        try {
            $this->carRepository->deleteById($carId);
            $message = sprintf('Success, car with id "%s" was deleted!', $carId);
        } catch (\Exception $exception) {
            $exceptionMessage = $exception->getMessage();
            $message = sprintf('Could not delete car with id: %s; message: %s', $carId, $exceptionMessage);
        }

        return $message;
    }
}
