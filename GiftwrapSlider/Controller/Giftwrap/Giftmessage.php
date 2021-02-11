<?php

namespace Team1\GiftwrapSlider\Controller\Giftwrap;

/**
 * Class Index
 */
class Giftmessage extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $quoteRepository;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;

        parent::__construct($context);
    }

    public function updateQuoteData($quoteId, $giftmessage)
    {
        $quote = $this->quoteRepository->get($quoteId); // Get quote by id
        $quote->setData('giftmessage', $giftmessage); // Fill data
        $this->quoteRepository->save($quote); // Save quote
    }

    /**
     * execute the action
     *
     * @return \Magento\Backend\Model\View\Result\Page|Page
     */
    public function execute()
    {
        $giftmessage = $this->getRequest()->getParam('giftmessage');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
        echo $giftmessage;
        $quoteId = $cart->getQuote()->getId();
        $this->updateQuoteData($quoteId, $giftmessage);

    }
}
