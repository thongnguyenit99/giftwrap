<?php
namespace Team1\GiftwrapSlider\Helper;

class PricingData extends \Magento\Framework\Pricing\Helper\Data
{
    public function format($value, $format = true, $includeContainer = true)
    {
        return $this->priceCurrency->format($value);
    }
}
?>