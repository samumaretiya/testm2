<?php
namespace Digital\Foodneeds\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {
	
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
		\Digital\Foodneeds\Model\Foodneeds $foodneedsFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
		$this->foodneedslFactory = $foodneedsFactory;
        $this->_storeManager = $storeManager;        
    }
    /**
     * Path to store config if extension is enabled
     *
     * @var string
     */
    const XML_PATH_ENABLED = 'foodneeds/foodneeds/enabled';
    const XML_PATH_Pagination_value = 'foodneeds/foodneeds/pagination_value';       
	
    /**
     * Check if extension enabled
     *
     * @return string|null
     */
    public function isEnabled() {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
	
	public function getEntreeColletion() {
		if($this->isEnabled()) {			
			$collection = $this->foodneedslFactory->getCollection()
				->addFieldToSelect('foodneed_id')
				->addFieldToSelect('choice_of_entree')			
				->setOrder('rank', 'ASC')
				->addFieldToFilter('status','0');				
			$collection->getSelect()->group('choice_of_entree');
			return $collection;
		} else {
			return '';
		}	
	}
	public function getMaincourseColletion() {		
		if($this->isEnabled()) {
			$collection = $this->foodneedslFactory->getCollection()
				->addFieldToSelect('foodneed_id')			
				->addFieldToSelect('choice_of_main_course')
				->setOrder('rank', 'ASC')
				->addFieldToFilter('status','0');
			$collection->getSelect()->group('choice_of_main_course');
			return $collection;
		} else {
			return '';
		}	
	}
}