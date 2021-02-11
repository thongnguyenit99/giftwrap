<?php

namespace Team1\GiftwrapSlider\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\View\LayoutInterface;

class ConfigProvider implements ConfigProviderInterface
{
    /** @var LayoutInterface  */
    protected $_layout;
    protected $giftwrapGet;

    public function __construct(
        LayoutInterface $layout,
        \Team1\GiftwrapSlider\Block\GiftwrapGet $giftwrapGet
    )
    {
        $this->_layout = $layout;
        $this->giftwrapGet = $giftwrapGet;
    }

    public function getConfig()
    {

        return [
            'giftwrap_block_content' => $this->_layout->createBlock('Team1\GiftwrapSlider\Block\GiftwrapGet')->setTemplate('Team1_GiftwrapSlider::giftwrapSlider.phtml')->toHtml(),
            'giftwrap_label' => $this->giftwrapGet->getCurrentGiftwrapName()
        ];
    }
}