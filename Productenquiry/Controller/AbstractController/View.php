<?php

namespace Digital\Productenquiry\Controller\AbstractController;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;

abstract class View extends Action\Action
{
    /**
     * @var \Digital\Productenquiry\Controller\AbstractController\ProductenquiryLoaderInterface
     */
    protected $productenquiryLoader;
	
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param OrderLoaderInterface $orderLoader
	 * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, ProductenquiryLoaderInterface $productenquiryLoader, PageFactory $resultPageFactory)
    {
        $this->productenquiryLoader = $productenquiryLoader;
		$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Productenquiry view page
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->productenquiryLoader->load($this->_request, $this->_response)) {
            return;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
		return $resultPage;
    }
}
