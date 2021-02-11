<?php

namespace Team1\GiftwrapSlider\Block\Adminhtml\Sales;

class Totals extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magecomp\Extrafee\Helper\Data
     */
    protected $giftwrapGet;
   

    /**
     * @var \Magento\Directory\Model\Currency
     */
    protected $_currency;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Team1\GiftwrapSlider\Block\GiftwrapGet $giftwrapGet,
        \Magento\Directory\Model\Currency $currency,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->giftwrapGet = $giftwrapGet;
        $this->_currency = $currency;
    }

    /**
     * Retrieve current order model instance
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    /**
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->_currency->getCurrencySymbol();
    }

    /**
     *
     *
     * @return $this
     */
    public function initTotals()
    {
        $parent=$this->getParentBlock();
        $this->getOrder();
        $this->getSource();
        $price = $this->getSource()->getGiftwrap();
        $label = $this->getSource()->getGiftwrapName();

        if (!$this->getSource()->getGiftwrap()) {
            return $this;
        }

        if($label=='' | $price==0){

        }
        else{
            $giftwrap = new \Magento\Framework\DataObject(
                [
                    'code' => 'giftwrap',
                    'strong' => false,
                    'value' => $price,
                    'label' => 'Gift Wrap '.$label,
                ]
            );
            $parent->addTotalBefore($giftwrap, 'grand_total');
            return $this;
        }
    }
}
