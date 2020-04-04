<?php

namespace Vitalii\Test\Model\ResourceModel\CarResource;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vitalii\Test\Model\CarModel;
use Vitalii\Test\Model\ResourceModel\CarResource as CarResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = CarModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            CarModel::class,
            CarResourceModel::class
        );
    }
}
