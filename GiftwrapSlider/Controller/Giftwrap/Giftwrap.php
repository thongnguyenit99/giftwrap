<?php

namespace Team1\GiftwrapSlider\Controller\Giftwrap;

/**
 * Class Index
 */
class Giftwrap extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $quoteRepository;
    protected $resultFactory;
    protected $_storeManager;
    protected $priceCurrency;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->resultFactory = $resultFactory;
        $this->_storeManager = $storeManager;
        $this->priceCurrency = $priceCurrency;

        parent::__construct($context);
    }

    public function updateQuoteData($quoteId, $giftwrapPrice, $giftwrapName)
    {
        $quote = $this->quoteRepository->get($quoteId); // Get quote by id
        $quote->setData('giftwrap', $giftwrapPrice); // Fill data
        $quote->setData('giftwrap_name', $giftwrapName);
        $this->quoteRepository->save($quote); // Save quote
    }

    /**
     * execute the action
     *
     * @return \Magento\Backend\Model\View\Result\Page|Page
     */
    public function execute()
    {
        $giftwrapPrice = $this->getRequest()->getParam('giftwrapprice');
        $currencyRate = $this->getCurrentCurrencyRate();
        $giftwrapName = $this->getRequest()->getParam('giftwrapname');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');    
        $quoteId = $cart->getQuote()->getId();
        $this->updateQuoteData($quoteId, $giftwrapPrice, $giftwrapName);
        $baseGrandTotal = $cart->getQuote()->getBaseGrandTotal();
        $grandTotal = $this->getFormatedPrice($baseGrandTotal);
        $giftwrapCurrencyPrice = $this->getFormatedPrice($giftwrapPrice);
        $response = $this->resultFactory
        ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
        ->setData([
            'grandtotal'  => $grandTotal,
            'giftwrap' => $giftwrapCurrencyPrice,
            'giftwrapname' => $giftwrapName,
            'basegrandtotal' => $baseGrandTotal,
        ]);
       return $response;
        
    }

    public function getCurrentCurrencyRate()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyRate();
    }

    public function getFormatedPrice($price)
    {
        $currentCurrencyCode = $this->getCurrentCurrencyCode();
        if ($currentCurrencyCode == "VND") {
            return $this->priceCurrency->convertAndFormat($price, true, 0);
        }
        return $this->priceCurrency->convertAndFormat($price, true, 2);
    }

    public function getCurrentCurrencyCode()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }    
}
