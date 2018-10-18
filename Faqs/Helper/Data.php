<?php
namespace Digital\Faqs\Helper;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
       
        $this->_storeManager = $storeManager;
        
    }
    /**
     * Path to store config if extension is enabled
     *
     * @var string
     */
    const XML_PATH_ENABLED = 'faqs/faqs/enabled';
    const XML_PATH_Pagination_value = 'faqs/faqs/pagination_value';
    
    
	
    /**
     * Check if extension enabled
     *
     * @return string|null
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }  
    public function getPaginationvalue()
    {
		return $this->scopeConfig->getValue(
            self::XML_PATH_Pagination_value,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );		
	} 
   
}
