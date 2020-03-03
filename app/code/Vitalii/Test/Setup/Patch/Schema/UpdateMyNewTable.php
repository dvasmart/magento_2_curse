<?php

namespace Vitalii\Test\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class UpdateMyNewTable
 */
class UpdateMyNewTable implements SchemaPatchInterface
{
    /**
     * @var SchemaSetupInterface
     */
    private $schemaSetup;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param SchemaSetupInterface $schemaSetup
     * @param LoggerInterface $logger
     */
    public function __construct(
        SchemaSetupInterface $schemaSetup,
        LoggerInterface $logger
    ) {
        $this->schemaSetup = $schemaSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->schemaSetup->startSetup();
        $this->modifyMyNewTable();
        $this->schemaSetup->endSetup();
    }

    /**
     * @return void
     */
    private function modifyMyNewTable()
    {
        $setup = $this->schemaSetup;
        $connection = $setup->getConnection();
        $myTable = $setup->getTable('my_new_way_table');

        /**
         * If `my_new_way_table` table doesn't exist - do nothing
         */
        if (!$connection->isTableExists($myTable)) {
            return;
        }

        $connection->addColumn(
            $myTable,
            'price',
            [
                'type' => Table::TYPE_DECIMAL,
                'scale' => 4,
                'precision' => 20,
                'unsigned' => false,
                'nullable' => true,
                'default' => 00.0000,
                'comment' => "Base Car Price"
            ]
        );
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
