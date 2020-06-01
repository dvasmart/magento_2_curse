<?php

namespace Vitalii\Foo\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Example
 */
class Example extends Action
{

    protected $title;

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $this->setTitle('Welcome');
        echo $this->getTitle();
    }

    /**
     * @param $title
     * @return string
     */
    public function setTitle($title)
    {
        return $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
