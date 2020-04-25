<?php

namespace Vitalii\Exam\Model\ResourceModel\ColorResource;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vitalii\Exam\Model\ColorModel;
use Vitalii\Exam\Model\ResourceModel\ColorResource as ColorResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = ColorModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            ColorModel::class,
            ColorResourceModel::class
        );
    }
}
