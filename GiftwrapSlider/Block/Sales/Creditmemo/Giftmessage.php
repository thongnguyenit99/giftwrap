<?php

namespace Team1\GiftwrapSlider\Block\Sales\Creditmemo;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context as TemplateContext;
use Magento\Sales\Model\Order\Creditmemo;

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

    public function __construct(
        TemplateContext $context,
        Registry $registry,
        \Team1\GiftwrapSlider\Model\GiftwrapFactory $giftwrapFactory,
        \Magento\Framework\UrlInterface $urlInterface,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        $this->_giftwrapFactory = $giftwrapFactory;
        $this->_urlInterface = $urlInterface;
        parent::__construct($context, $data);
    }

    public function getCreditmemo() : Creditmemo
    {
        return $this->coreRegistry->registry('current_creditmemo');
    }

    public function getGiftmessage()
    {
        return $this->getCreditmemo()->getData('giftmessage');
    }

    public function getBaseImgUrl() {
        return $this->_urlInterface->getBaseUrl() . 'media/Team1/GiftwrapSlider/giftwraps_slider/';
    }

    public function getGiftwrap()
    {
        $giftwrapName = $this->getCreditmemo()->getData('giftwrap_name');
        return $this->_giftwrapFactory->create()
            ->getCollection()
            ->addFieldToFilter('status', 1)
            ->addFieldToFilter('title', $giftwrapName);
    }

    public function getHiddenPrice()
    {
        return $this->getCreditmemo()->getData('hide_price');
    }
}
