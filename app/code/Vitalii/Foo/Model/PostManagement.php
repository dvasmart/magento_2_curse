<?php
namespace Vitalii\Foo\Model;


class PostManagement {

    /**
     * {@inheritdoc}
     */
    public function getPost($param)
    {
        return 'api GET return the $param ' . $param;
    }
}
