<?php

namespace Vitalii\Exam\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Vitalii\Exam\Model\ColorModel;

/**
 * Class ColorResource
 */
class ColorResource extends AbstractDb
{
    const COLOR_TABLE = 'exam_secondary_table';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::COLOR_TABLE,
            ColorModel::ENTITY_ID
        );
    }
}
