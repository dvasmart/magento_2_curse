<?php

namespace Vitalii\Test\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Vitalii\Test\Model\CarModel;

/**
 * Class CarResource
 */
class CarResource extends AbstractDb
{
    const CAR_TABLE = 'vitalii_cars';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::CAR_TABLE,
            CarModel::ENTITY_ID
        );
    }
}
