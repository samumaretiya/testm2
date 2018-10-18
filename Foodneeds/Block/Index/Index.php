<?php
namespace Digital\Foodneeds\Block\Index;
use Magento\Framework\ObjectManagerInterface;

class Index extends \Magento\Framework\View\Element\Template 
{
	
	protected $helper;
     protected $objectManager;
     
    public function __construct(
    \Magento\Catalog\Block\Product\Context $context,
    \Digital\Foodneeds\Model\Foodneeds $mymodulemodelFactory, 
    \Digital\Foodneeds\Helper\Data $helper, 
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
		return $this;		
	}
	public function isFoodneedsEnabled()	
	{  
		return $this->_helper->isEnabled();
		
	}
	
	public function getFoodneedsColletion() {		
		$collection = $this->mymodulemodelFactory->getCollection()
			->addFieldToSelect('foodneed_id')
			->addFieldToSelect('choice_of_entree')
			->addFieldToSelect('choice_of_main_course')
			->setOrder('rank', 'ASC')
			->addFieldToFilter('status','0');																 
			//$collection->setPageSize($pageSize)
			//->setCurPage($page);
		return $collection;
	}
}
