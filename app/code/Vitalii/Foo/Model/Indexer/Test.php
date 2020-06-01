<?php

namespace Vitalii\Foo\Model\Indexer;

use Magento\Framework\Indexer\ActionInterface;
use Magento\Framework\Mview\ActionInterface as MviewActionInterface;

/**
 * Class Test
 */
class Test implements ActionInterface, MviewActionInterface
{
    /*
     * Used by mview, allows process indexer in the "Update on schedule" mode
     */
    public function execute($ids){

        //code here!
    }

    /*
     * Will take all of the data and reindex
     * Will run when reindex via command line
     */
    public function executeFull(){
        //code here!
    }

    /*
     * Works with a set of entity changed (may be massaction)
     */
    public function executeList(array $ids){
        //code here!
    }

    /*
     * Works in runtime for a single entity using plugins
     */
    public function executeRow($id){
        //code here!
    }
}
