<?php

namespace Vitalii\Test\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ExtraInfo
 */
class ExtraInfo implements ArgumentInterface
{
    const USE_AJAX_LOADING = 'vitalii_test/settings/use_ajax';

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
     * @return string
     */
    public function getCurrentDate()
    {
        $result = '';
        try {
            $date = new \DateTime('now');
            $result = $date->format('d-M-yy');
        } catch (\Exception $exception) {
            // logger->debug();
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function useAjax()
    {
        $result = false;
        try {
            $result = $this->scopeConfig->isSetFlag(
                self::USE_AJAX_LOADING,
                ScopeInterface::SCOPE_STORES
            );
        } catch (\Exception $exception) {
            // logger->debug();
        }

        return $result;
    }
}
