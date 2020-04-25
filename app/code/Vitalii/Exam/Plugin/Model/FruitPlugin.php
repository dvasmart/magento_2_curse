<?php

namespace Vitalii\Exam\Plugin\Model;

use Vitalii\Exam\Api\Data\FruitInterface;

/**
 * Class FruitPlugin
 */
class FruitPlugin
{
    /**
     * @param FruitInterface $subject
     * @return array
     */
    public function beforeGetDescription(FruitInterface $subject)
    {
        echo "\r\n" . __('Plugin Before Get Description Message - ')->render() . "\r\n";
        return [];
    }

    /**
     * @param FruitInterface $subject
     * @param string $result
     * @return string
     */
    public function afterGetDescription(FruitInterface $subject, $result)
    {
        return $result . __(' - Plugin After Get Description Message')->render();
    }
}
