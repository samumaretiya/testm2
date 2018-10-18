<?php
namespace Digital\Faqs\Block\Index;
use Magento\Framework\ObjectManagerInterface;

class Index extends \Magento\Framework\View\Element\Template 
{
	
	protected $helper;
     protected $objectManager;
     
    public function __construct(
    \Magento\Catalog\Block\Product\Context $context,
    \Digital\Faqs\Model\Faqs $mymodulemodelFactory, 
    \Digital\Faqs\Helper\Data $helper, 
     ObjectManagerInterface $objectManager,
    array $data = [])
    {
		$this->_helper=$helper;
		 $this->objectManager = $objectManager;
		$this->mymodulemodelFactory = $mymodulemodelFactory;
        parent::__construct($context, $data);
	}

	protected function _prepareLayout()
	{
		parent::_prepareLayout();
			if ($this->getFaqsColletion())
			{
				$pager = $this->getLayout()->createBlock(
				'Magento\Theme\Block\Html\Pager',
				'Digital.company.pager'
					)->setAvailableLimit(array($this->_helper->getPaginationvalue()))->setShowPerPage(true)->setCollection($this->getFaqsColletion());
        
				$this->setChild('pager', $pager);
				$this->getFaqsColletion()->load();
			}
		return $this;
	}
	public function isFaqsEnabled()	
	{  
		return $this->_helper->isEnabled();
		
	}
	/*public function getPagevalue(){
		return $this->_helper->getPaginationvalue();
	}*/
	public function getFaqsColletion()
	{
		
		$page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
    
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : $this->_helper->getPaginationvalue();
		//$ezicredit = (int)$this->getRequest()->getParam('ezicredit');
		$collection = $this->mymodulemodelFactory->getCollection()->addFieldToSelect('faq_id')
																  ->addFieldToSelect('question')
																  ->addFieldToSelect('answer')
																  ->setOrder('rank', 'ASC')
																  ->addFieldToFilter('status','0');
																  /*if($ezicredit){
																	$collection->addFieldToFilter('faq_type',\Digital\Faqs\Model\Status::FAQ_EZICREDIT_VALUE);
																  } else {
																	$collection->addFieldToFilter('faq_type',\Digital\Faqs\Model\Status::FAQ_NORMAL_VALUE);
																  }*/
																  $collection->setPageSize($pageSize)
																  ->setCurPage($page);
		
		//echo $collection->getSelect()->__toString();	
		 //print_r($collection->getData());
		return $collection;
	}
	/*public function getEziCreditCollection(){
		
	}*/
	public function getPagerHtml()
	{
		return $this->getChildHtml('pager');
	}
}
