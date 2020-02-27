<?php

namespace Vitalii\Test\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Tax\Api\TaxClassManagementInterface;

/**
 * Class InstallData
 */
class InstallData implements InstallDataInterface
{
    /**
     * {@inheritDoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $myTable = $setup->getTable('my_old_fashioned_table');
        $data = [
            [
                'entity_id' => null,
                'email' => 'example@gmail.com',
                'some_id' => 278
            ],
            [
                'entity_id' => null,
                'email' => 'my_new_email@i.ua',
                'some_id' => 111
            ],
            [
                'entity_id' => null,
                'email' => 'roma@gmail.com',
                'some_id' => 222
            ],
            [
                'entity_id' => null,
                'email' => 'sania11@gmail.com',
                'some_id' => 321
            ],
            [
                'entity_id' => null,
                'email' => 'myemail@i.ua',
                'some_id' => 872
            ]
        ];

        $setup->getConnection()->insertMultiple($myTable, $data);
    }
}
