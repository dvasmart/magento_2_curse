<?php


namespace Vitalii\Exam\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;

/**
 * Class GetConfig
 */
class GetConfig implements ArgumentInterface
{
    const COLORS_NUMBER = 'fruits_colors_config/settings_input/number_of_colors';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param LoggerInterface $logger
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        LoggerInterface $logger
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
    }

    /**
     * @return int
     */
    public function getColorsNumber()
    {
        $number = 1;
        try {
            $number = $this->scopeConfig->getValue(self::COLORS_NUMBER, ScopeInterface::SCOPE_STORES);
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot print number of colors, message: "'. $exception->getMessage() . '"');
        }
        return (int)$number;
    }
}
