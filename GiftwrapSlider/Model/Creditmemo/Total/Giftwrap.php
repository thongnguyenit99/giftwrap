<?php

namespace Team1\GiftwrapSlider\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;

class Giftwrap extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Creditmemo $creditmemo
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Creditmemo $creditmemo)
    {
        $creditmemo->setGiftwrap(0);
        
        $amount = $creditmemo->getOrder()->getGiftwrap();
        $giftwrapName = $creditmemo->getOrder()->getGiftwrapName();
        $giftmessage = $creditmemo->getOrder()->getGiftmessage();
        $hiddenPrice = $creditmemo->getOrder()->getHidePrice();

        $creditmemo->setGiftwrap($amount);
        $creditmemo->setGiftwrapName($giftwrapName);
        $creditmemo->setGiftmessage($giftmessage);
        $creditmemo->setHidePrice($hiddenPrice);

        $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $creditmemo->getGiftwrap());
        $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $creditmemo->getGiftwrap());

        return $this;
    }
}
