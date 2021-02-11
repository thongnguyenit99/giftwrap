<?php


namespace Team1\GiftwrapSlider\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class Image extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * Url path
     */
    const URL_PATH_EDIT = 'team1giftwrapslider/giftwrap/edit';

    /**
     * @var \Team1\GiftwrapSlider\Model\Giftwrap
     */
    protected $giftwrap;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Team1\GiftwrapSlider\Model\Giftwrap $giftwrap
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Team1\GiftwrapSlider\Model\Giftwrap $giftwrap,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->giftwrap = $giftwrap;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $giftwrap = new \Magento\Framework\DataObject($item);
                $item[$fieldName . '_src'] = $this->giftwrap->getImageUrl($giftwrap['image']);
                $item[$fieldName . '_orig_src'] = $this->giftwrap->getImageUrl($giftwrap['image']);
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                    self::URL_PATH_EDIT,
                    ['id' => $giftwrap['giftwrap_id']]
                );
                $item[$fieldName . '_alt'] = $giftwrap['title'];
            }
        }
        return $dataSource;
    }
}