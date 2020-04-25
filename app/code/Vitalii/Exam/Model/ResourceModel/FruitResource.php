<?php

namespace Vitalii\Exam\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Vitalii\Exam\Model\FruitModel;

/**
 * Class FruitResource
 */
class FruitResource extends AbstractDb
{
    const FRUIT_TABLE = 'exam_main_table';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::FRUIT_TABLE,
            FruitModel::ENTITY_ID
        );
    }
}
