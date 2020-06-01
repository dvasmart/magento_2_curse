<?php

namespace Vitalii\Foo\Plugin;

use Vitalii\Foo\Controller\Index\Example;

/**
 * Class ExamplePlugin
 */
class ExamplePlugin
{

    /**
     * @param Example $subject
     * @param $title
     * @return string[]
     */
    public function beforeSetTitle(Example $subject, $title)
    {
        $title = " before plugin + " . $title;
        return [$title];
    }

    /**
     * @param Example $subject
     * @param $result
     * @return string
     */
    public function afterGetTitle(Example $subject, $result)
    {
        return $result . " + after plugin";
    }

    /**
     * @param Example $subject
     * @param callable $proceed
     * @return string
     */
    public function aroundGetTitle(Example $subject, callable $proceed)
    {
        echo __METHOD__ . " - Before proceed() </br>";
        $result = $proceed();
        echo __METHOD__ . " - After proceed() </br>";

        return $result;
    }
}
