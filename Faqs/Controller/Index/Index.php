<?php
namespace Digital\Faqs\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
 
class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
		//return $this->resultFactory->create();
        $resultPage = $this->resultPageFactory->create();
       
			$resultPage->getConfig()->getTitle()->set(__("FAQ's"));
			$breadcrumbs = $resultPage->getLayout()->getBlock('breadcrumbs');
			$breadcrumbs->addCrumb('home', [
				'label' => __('Home'),
				'title' => __('Home'),
				'link' => $this->_url->getUrl('')
					]
			);
			$breadcrumbs->addCrumb('faqs', [
				'label' => __("FAQ's"),
				'title' => __("FAQ's")
					]
			);
		
        return $resultPage;
    }
}
