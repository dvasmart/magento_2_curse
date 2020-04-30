<?php

namespace Vitalii\Exam\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

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
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return int
     */
    public function getColorsNumber()
    {
        return (int)$this->scopeConfig->getValue(self::COLORS_NUMBER, ScopeInterface::SCOPE_STORES);
    }
}
