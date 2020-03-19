<?php

namespace Vitalii\Test\Plugin\Model;

use Vitalii\Test\Api\Data\CarInterface;

/**
 * Class CarPlugin
 */
class CarPlugin
{
    /**
     * @param CarInterface $subject
     * @return array
     */
    public function beforeGetDescription(CarInterface $subject)
    {
        echo "\r\n" . __('Before Get Description -')->render() . "\r\n";
        return [];
    }

    /**
     * @param CarInterface $subject
     * @param string $result
     * @return string
     */
    public function afterGetDescription(CarInterface $subject, $result)
    {
        return $result . __(' - after!')->render();
    }
}
