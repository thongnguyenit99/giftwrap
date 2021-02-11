<?php

namespace Team1\GiftwrapSlider\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Checkout\Model\Session;

class CustomGiftwrapPaypalObserver implements ObserverInterface
{
    protected $checkout;

    public function __construct(
        Session $checkout
    )
    {
        $this->checkout = $checkout;
    }

    public function execute(Observer $observer)
    {
        $cart = $observer->getEvent()->getCart();
        $quote = $this->checkout->getQuote();
        $giftwrap = $quote->getGiftwrap();
        $giftwrapName = $quote->getGiftwrapName();


        if($giftwrap) {
            $cart->addCustomItem($giftwrapName, 1, 1.00 * $giftwrap, $giftwrapName);
        }
    }
}
