<?php


namespace Vitalii\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class PutDataInMyNewTable
 */
class PutDataInMyNewTable implements DataPatchInterface
{
    const MY_NEW_WAY_TABLE = 'my_new_way_table';

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
            $data = [
                [
                    'entity_id' => null,
                    'user_id' => 1,
                    'car_id' => 7272811,
                    'description' => 'Ford Mustang GT',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'user_id' => 1,
                    'car_id' => 7272812,
                    'description' => 'Renault Logan',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'user_id' => 2,
                    'car_id' => 2272811,
                    'description' => 'Honda CR V',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'user_id' => 3,
                    'car_id' => 3272812,
                    'description' => 'Volkswagen Passat b8',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'user_id' => 3,
                    'car_id' => 3232812,
                    'description' => 'Nissan Skyline',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'user_id' => 3,
                    'car_id' => 3272814,
                    'description' => 'Volkswagen xc90',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'user_id' => 4,
                    'car_id' => 4272813,
                    'description' => 'Lamborghini Aventador',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'user_id' => 5,
                    'car_id' => 5272812,
                    'description' => 'Porsche Carrera GT',
                    'created_at' => '',
                ],
            ];

        $this->moduleDataSetup->startSetup();

        try {
            $connection = $this->moduleDataSetup->getConnection();
            $connection->truncateTable(MY_NEW_WAY_TABLE);
            foreach ($data as $row) {
                $connection->insert(self::MY_NEW_WAY_TABLE, $row);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
