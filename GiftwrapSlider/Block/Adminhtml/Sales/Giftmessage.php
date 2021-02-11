<?php

namespace Team1\GiftwrapSlider\Block\Adminhtml\Sales;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context as TemplateContext;
use Magento\Sales\Model\Order;

class Giftmessage extends \Magento\Framework\View\Element\Template
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;
    protected $_giftwrapFactory;
    protected $_urlInterface;
    protected $priceCurrency;


    public function __construct(
        TemplateContext $context,
        Registry $registry,
        \Team1\GiftwrapSlider\Model\GiftwrapFactory $giftwrapFactory,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        $this->_giftwrapFactory = $giftwrapFactory;
        $this->_urlInterface = $urlInterface;
        $this->priceCurrency = $priceCurrency;
        $this->_template = 'order/view/comment.phtml';
        parent::__construct($context, $data);
    }

    public function getOrder() : Order
    {
        return $this->coreRegistry->registry('current_order');
    }

    public function getGiftmessage()
    {
        return $this->getOrder()->getData('giftmessage');
    }
    public function getHiddenPrice()
    {
        return $this->getOrder()->getData('hide_price');
    }
    public function getBaseImgUrl() {
        return $this->_urlInterface->getBaseUrl() . 'media/Team1/GiftwrapSlider/giftwraps_slider/';
    }

    public function getGiftwrap()
    {
        $giftwrapName = $this->getOrder()->getData('giftwrap_name');
        return $this->_giftwrapFactory->create()
            ->getCollection()
            ->addFieldToFilter('status', 1)
            ->addFieldToFilter('title', $giftwrapName);
    }
    public function getOrderCurrencyCode()
    {
        return $this->getOrder()->getData('order_currency_code');
    }

    public function getFormatedPrice($price)
    {
        $orderCurrencyCode = $this->getOrderCurrencyCode();
        if ($orderCurrencyCode == "VND") {
            return $this->priceCurrency->convertAndFormat($price, true, 0, null, $orderCurrencyCode);
        }
        return $this->priceCurrency->convertAndFormat($price, true, 2, null, $orderCurrencyCode);
    }
}
