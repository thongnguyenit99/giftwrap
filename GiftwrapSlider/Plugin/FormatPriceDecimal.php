<?php
namespace Team1\GiftwrapSlider\Plugin;

use Magento\Framework\Pricing\PriceCurrencyInterface;

class FormatPriceDecimal
{
    protected $_storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ){
        $this->_storeManager = $storeManager; 
    }

    public function beforeConvertAndFormat(
        \Magento\Directory\Model\PriceCurrency $subject, 
        $amount,
        $includeContainer = true,
        $precision = PriceCurrencyInterface::DEFAULT_PRECISION,
        $scope = null,
        $currency = null)
    {
        $currentCurrencyCode = $this->getCurrentCurrencyCode();
        if ($currentCurrencyCode == "VND" && $currency == null) {
            $precision = 0;
        }

        return [$amount, $includeContainer, $precision, $scope, $currency];
    }

    public function beforeFormat(
        \Magento\Directory\Model\PriceCurrency $subject, 
        $amount,
        $includeContainer = true,
        $precision = PriceCurrencyInterface::DEFAULT_PRECISION,
        $scope = null,
        $currency = null)
    {
        $currentCurrencyCode = $this->getCurrentCurrencyCode();
        if ($currentCurrencyCode == "VND" && $currency == null) {
            $precision = 0;
        }

        return [$amount, $includeContainer, $precision, $scope, $currency];
    }

    public function getCurrentCurrencyCode()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }  
}