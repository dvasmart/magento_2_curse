<?php

namespace Vitalii\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Vitalii\Test\Api\CarRepositoryInterface;
use Vitalii\Test\Api\Data\CarInterface;
use Vitalii\Test\Api\Data\CarInterfaceFactory;
use Psr\Log\LoggerInterface;

/**
 * Class GenerateVitaliiCarsData
 */
class GenerateVitaliiCarsData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CarInterfaceFactory
     */
    private $carFactory;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CarInterfaceFactory $carFactory
     * @param CarRepositoryInterface $carRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CarInterfaceFactory $carFactory,
        CarRepositoryInterface $carRepository,
        LoggerInterface $logger
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->carFactory = $carFactory;
        $this->carRepository = $carRepository;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        echo 'Vitalii_Test:GenerateVitaliiCarsData:Data:startSetup' . "\r\n";

        try {
            $data = [
                [
                    'entity_id' => null,
                    'user_id' => 1,
                    'car_id' => 7272811,
                    'description' => 'Ford Mustang GT',
                    'created_at' => '',
                    'price' => 90000.9200
                ],
                [
                    'entity_id' => null,
                    'user_id' => 1,
                    'car_id' => 7272812,
                    'description' => 'Renault Logan',
                    'created_at' => '',
                    'price' => 23000.0191
                ],
                [
                    'entity_id' => null,
                    'user_id' => 2,
                    'car_id' => 2272811,
                    'description' => 'Honda CR V',
                    'created_at' => '',
                    'price' => 150999.9988
                ],
                [
                    'entity_id' => null,
                    'user_id' => 3,
                    'car_id' => 3272812,
                    'description' => 'Volkswagen Passat b8',
                    'created_at' => '',
                    'price' => 20300.8731
                ],
                [
                    'entity_id' => null,
                    'user_id' => 3,
                    'car_id' => 3232812,
                    'description' => 'Nissan Skyline',
                    'created_at' => '',
                    'price' => 839090.0000
                ],
                [
                    'entity_id' => null,
                    'user_id' => 3,
                    'car_id' => 3272814,
                    'description' => 'Volkswagen xc90',
                    'created_at' => '',
                    'price' => 298000.9911
                ],
                [
                    'entity_id' => null,
                    'user_id' => 4,
                    'car_id' => 4272813,
                    'description' => 'Lamborghini Aventador',
                    'created_at' => '',
                    'price' => 9100300.2000
                ],
                [
                    'entity_id' => null,
                    'user_id' => 5,
                    'car_id' => 5272812,
                    'description' => 'Porsche Carrera GT',
                    'created_at' => '',
                    'price' => 2003300.0000
                ],
            ];
            foreach ($data as $row) {
                /** @var CarInterface $newCar */
                $newCar = $this->carFactory->create();
                $newCar->setCarId($row['car_id']);
                $newCar->setUserId($row['user_id']);
                $newCar->setDescription($row['description']);
                $newCar->setCreatedAt('now');
                $newCar->setPrice($row['price']);
                $this->carRepository->save($newCar);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot save new car model, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Vitalii_Test:GenerateVitaliiCarsData:Data:endSetup' . "\r\n";
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
            GenerateVitaliiCustomersData::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
