<?php

namespace Vitalii\Test\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * Class UpgradeSchema
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        // beware, this is the version we are upgrading from, not to!
        $moduleVersion = $context->getVersion();
        if (version_compare($moduleVersion, '0.0.2', '<')) {
            $this->updateMyTable($setup);
        }
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function updateMyTable($setup)
    {
        $setup->startSetup();
        $myTable = $setup->getTable('my_old_fashioned_table');
        $setup->getConnection()->modifyColumn(
                $myTable,
                'some_id',
                [
                    'type' => Table::TYPE_INTEGER,
                    'size' => 11
                ]
            )
            ->addColumn(
            $myTable,
            'name',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 128,
                'nullable' => true,
                'comment' => 'Customer Name'
            ]
        );
        $setup->endSetup();
    }
}
