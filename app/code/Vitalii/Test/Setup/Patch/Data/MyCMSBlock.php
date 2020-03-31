<?php


namespace Vitalii\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;
use Magento\Cms\Model\BlockFactory;

/**
 * Class MessageCMSBlock
 */
class MyCMSBlock implements DataPatchInterface
{
    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger,
        BlockFactory $blockFactory
    )
    {
        $this->blockFactory=$blockFactory;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {

        $this->moduleDataSetup->startSetup();


        $data = [
            'title' => 'Message for CMS block',
            'identifier' => 'my_block',
            'stores' => [0, 1, 2, 3],
            'is_active' => 1,
            'content' => '<p>My Hello message for cms block</p>',
        ];
        try {
            $this->blockFactory->create()->setData($data)->save();
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert block, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
