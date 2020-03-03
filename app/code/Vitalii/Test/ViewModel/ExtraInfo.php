<?php

namespace Vitalii\Test\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class ExtraInfo
 */
class ExtraInfo implements ArgumentInterface
{
    /**
     * @return string
     */
    public function getCurrentDate()
    {
        $result = '';
        try {
            $date = new \DateTime('now');
            $result = $date->format('d-M-yy');
        } catch (\Exception $exception) {
            // logger->debug();
        }

        return $result;
    }
}
