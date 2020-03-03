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
     * @inheritdoc
     */
    public function getCarsList()
    {
        /** @var SearchCriteria $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder->create();
        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->carRepository->getList($searchCriteria);
        $resultArray = [];
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

        return $resultArray;
    }

    /**
     * @inheritdoc
     */
    public function getCarsListByUserId($userId)
    {
        if (empty($userId)) {
            return false;
        }

        /** @var SearchCriteria $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(CarInterface::USER_ID, $userId)
            ->create();
        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->carRepository->getList($searchCriteria);
        $resultArray = [];
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

        return $resultArray;
    }

    /**
     * {@inheritDoc}
     */
    public function save(CarInterface $car)
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
    public function delete(int $carId)
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
