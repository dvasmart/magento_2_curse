<?php

namespace Vitalii\Test\Model\ResourceModel\CarCustomer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vitalii\Test\Model\CarCustomerModel;
use Vitalii\Test\Model\ResourceModel\CarCustomer as CarCustomerResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = CarCustomerModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            CarCustomerModel::class,
            CarCustomerResourceModel::class
        );
    }

    /**
     * @return void
     */
    public function addMySortOrder()
    {
        $this->setOrder(CarCustomerModel::CREATED_AT, 'ASC');
    }
}
