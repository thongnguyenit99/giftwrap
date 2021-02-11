<?php

namespace Team1\GiftwrapSlider\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

class Giftwrap extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $invoice->setGiftwrap(0);
        
        $amount = $invoice->getOrder()->getGiftwrap();
        $giftwrapName = $invoice->getOrder()->getGiftwrapName();
        $giftmessage = $invoice->getOrder()->getGiftmessage();
        $hiddenPrice = $invoice->getOrder()->getHidePrice();

        $invoice->setGiftwrap($amount);
        $invoice->setGiftwrapName($giftwrapName);
        $invoice->setGiftmessage($giftmessage);
        $invoice->setHidePrice($hiddenPrice);

        $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getGiftwrap());
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getGiftwrap());

        return $this;
    }
}
