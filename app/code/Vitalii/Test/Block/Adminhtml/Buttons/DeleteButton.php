<?php

namespace Vitalii\Test\Block\Adminhtml\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Vitalii\Test\Api\Data\CarInterface;

/**
 * Class DeleteButton
 * @package Vitalii\Test
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $carId = $this->getCarId();
        if ($carId) {
            $data = [
                'label' => __('Delete Car'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl($carId) . '\')',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    /**
     * @param int|string
     * @return string
     */
    public function getDeleteUrl($carId)
    {
        return $this->getUrl('*/*/delete', [CarInterface::ENTITY_ID => $carId]);
    }
}
