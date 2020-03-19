<?php

namespace Vitalii\Test\Model\Cars;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\UrlInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Vitalii\Test\Api\Data\CarInterface;
use Vitalii\Test\Model\ResourceModel\CarResource\CollectionFactory as CarsCollectionFactory;
use Vitalii\Test\Model\ResourceModel\CarResource\Collection as CarsCollection;

/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var CarsCollection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array|null
     */
    protected $loadedData;

    /**
     * Url Builder
     *
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CarsCollectionFactory $carsCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param UrlInterface $urlBuilder
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CarsCollectionFactory $carsCollectionFactory,
        DataPersistorInterface $dataPersistor,
        UrlInterface $urlBuilder,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $carsCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        if ($this->loadedData === null) {
            $this->loadedData = [];
            $items = $this->collection->getItems();
            /** @var CarInterface $car */
            foreach ($items as $car) {
                $this->loadedData[$car->getId()] = $this->prepareData($car);
            }

            $data = $this->dataPersistor->get('cars');
            if (!empty($data)) {
                $car = $this->collection->getNewEmptyItem();
                $car->setData($data);
                $this->loadedData[$car->getId()] = $this->prepareData($car);
                $this->dataPersistor->clear('cars');
            }
        }

        return $this->loadedData;
    }

    /**
     * @param CarInterface $car
     * @return array
     */
    private function prepareData($car)
    {
        $data = $car->getData();
        return $data;

        if (isset($data['logo'])) {
            unset($data['logo']);
            $data['logo'][0]['name'] = $car->getData('logo');
            $data['logo'][0]['url'] = $this->getFileUrl($car->getLogo());
        }

        return $data;
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function getFileUrl($fileName)
    {
        return $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . 'cars/' . $fileName;
    }
}
