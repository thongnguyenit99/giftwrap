<?php

namespace Team1\GiftwrapSlider\Block\Sales\Totals;


class Giftwrap extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magecomp\Extrafee\Helper\Data
     */
    protected $giftwrapGet;

    /**
     * @var Order
     */
    protected $_order;

    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Team1\GiftwrapSlider\Block\GiftwrapGet $giftwrapGet,
        array $data = []
    )
    {
        $this->giftwrapGet = $giftwrapGet;
        parent::__construct($context, $data);
    }

    /**
     * Check if we nedd display full tax total info
     *
     * @return bool
     */
    public function displayFullSummary()
    {
        return true;
    }

    /**
     * Get data (totals) source model
     *
     * @return \Magento\Framework\DataObject
     */
    public function getSource()
    {
        return $this->_source;
    }

    public function getStore()
    {
        return $this->_order->getStore();
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * @return array
     */
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }

    /**
     * @return array
     */
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }

    /**
     * @return $this
     */
    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();
        $price=$this->_source->getGiftwrap();
        $label =$this->_source->getGiftwrapName();

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
            $parent->addTotal($giftwrap, 'giftwrap');
            return $this;
        }



    }

}
