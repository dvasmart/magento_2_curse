<?php

namespace Vitalii\Exam\Model\ResourceModel\FruitResource;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vitalii\Exam\Model\FruitModel;
use Vitalii\Exam\Model\ResourceModel\FruitResource as FruitResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = FruitModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            FruitModel::class,
            FruitResourceModel::class
        );
    }
}
