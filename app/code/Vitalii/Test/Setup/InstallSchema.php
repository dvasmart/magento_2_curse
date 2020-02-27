<?php

namespace Vitalii\Test\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Roma\Test\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable('my_old_fashioned_table');
        $table = $setup->getConnection()
            ->newTable($tableName)
            ->addColumn(
                'entity_id',
                Table::TYPE_SMALLINT,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Entity Id'
            )
            ->addColumn(
                'email',
                Table::TYPE_TEXT,
                64,
                [
                    'nullable' => false
                ],
                'Request Type'
            )
            ->addColumn(
                'some_id',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false,
                    'default' => '0'
                ],
                'Some ID'
            )
            ->addIndex(
                $setup->getIdxName(
                    $tableName,
                    [
                        'email'
                    ],
                    AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                [
                    'email'
                ],
                [
                    'type' => AdapterInterface::INDEX_TYPE_UNIQUE
                ]
            )
            ->setComment('My Custom Old Table!');
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
