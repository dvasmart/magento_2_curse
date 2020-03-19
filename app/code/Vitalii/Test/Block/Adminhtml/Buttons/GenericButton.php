<?php

namespace Vitalii\Test\Block\Adminhtml\Buttons;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Vitalii\Test\Api\CarRepositoryInterface;
use Vitalii\Test\Api\Data\CarInterface;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @param Context $context
     * @param CarRepositoryInterface $carRepository
     */
    public function __construct(
        Context $context,
        CarRepositoryInterface $carRepository
    ) {
        $this->context = $context;
        $this->carRepository = $carRepository;
    }

    /**
     * @return int|null
     */
    public function getCarId()
    {
        try {
            $request = $this->context->getRequest();
            $carId = (int)$request->getParam(CarInterface::ENTITY_ID);
            return $this->carRepository->getById($carId)->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
