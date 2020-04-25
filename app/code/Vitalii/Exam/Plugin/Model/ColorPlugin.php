<?php

namespace Vitalii\Exam\Plugin\Model;

use Vitalii\Exam\Api\Data\ColorInterface;

/**
 * Class ColorPlugin
 */
class ColorPlugin
{
    /**
     * @param ColorInterface $subject
     * @return array
     */
    public function beforeGetDescription(ColorInterface $subject)
    {
        echo "\r\n" . __('Plugin Before Get Description Message - ')->render() . "\r\n";
        return [];
    }

    /**
     * @param ColorInterface $subject
     * @param string $result
     * @return string
     */
    public function afterGetDescription(ColorInterface $subject, $result)
    {
        return $result . __(' - Plugin After Get Description Message')->render();
    }
}
