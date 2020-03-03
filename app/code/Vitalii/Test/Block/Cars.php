<?php

namespace Vitalii\Test\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vitalii\Test\Model\CarModel;
use Vitalii\Test\Model\ResourceModel\CarResource\Collection as CarsCollection;
use Vitalii\Test\Model\ResourceModel\CarResource\CollectionFactory as CarsCollectionFactory;

/**
 * Class Cars
 */
class Cars extends Template
{
    /**
     * @var CarsCollectionFactory
     */
    private $carsCollectionFactory;

    /**
     * @var CarsCollection|null
     */
    private $carsCollection;

    /**
     * @param Context $context
     * @param CarsCollectionFactory $carsCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CarsCollectionFactory $carsCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->carsCollectionFactory = $carsCollectionFactory;
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();
        $userId = (int)$request->getParam(CarModel::USER_ID);
        if ($userId > 0 && $this->carsCollection === null) {
            $this->carsCollection = $this->carsCollectionFactory->create();
            $this->carsCollection->addFieldToFilter(
                CarModel::USER_ID,
                ['eq' => $userId]
            );
        }

        return parent::_prepareLayout();
    }

    /**
     * @return CarsCollection|null
     */
    public function getCarsCollection()
    {
        return $this->carsCollection;
    }
}
