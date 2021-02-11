<?php

namespace Team1\GiftwrapSlider\Model\Total\Quote;

class GiftwrapCustom extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal {

    protected $_storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }

    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        
        parent::collect($quote, $shippingAssignment, $total);
        // issue 10413 . Fix it using $shippingAssignment and define format price
        $items = $shippingAssignment->getItems();
        if (!count($items)) {
            return $this;
        }
        //set collect price ,name,total Amount when checkout using paypal in table quocte 

        $giftwrap = $quote->getGiftwrap();
        $currencyRate = $this->getCurrentCurrencyRate();
        $giftwrapCurrencyPrice = (float)$giftwrap * $currencyRate;
        $giftwrapName = $quote->getGiftwrapName();
        $total->setTotalAmount('giftwrap', $giftwrapCurrencyPrice);
        $total->setBaseTotalAmount('giftwrap', $giftwrap);
        $total->setGiftwrap($giftwrap);
        $quote->setGiftwrap($giftwrap);
        $total->setGiftwrapName($giftwrapName);
        $quote->setGiftwrapName($giftwrapName); 
        return $this;
    }
 
    public function fetch(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        $giftwrap = $quote->getGiftwrap();
        $currencyRate = $this->getCurrentCurrencyRate();
        $giftwrapCurrencyPrice = (float)$giftwrap * $currencyRate;
        return [
            'code' => 'giftwrap',
            'title' => $this->getLabel(),
            'value' => $giftwrapCurrencyPrice  //You can change the reduced amount, or replace it with your own variable
        ];
    }

    public function getCurrentCurrencyRate()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyRate();
    }

}