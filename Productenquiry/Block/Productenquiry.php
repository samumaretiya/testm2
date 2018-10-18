<?php

namespace Digital\Productenquiry\Block;

/**
 * Productenquiry content block
 */
class Productenquiry extends \Magento\Framework\View\Element\Template
{
    /**
     * Productenquiry collection
     *
     * @var Digital\Productenquiry\Model\ResourceModel\Productenquiry\Collection
     */
    protected $_productenquiryCollection = null;
    
    /**
     * Productenquiry factory
     *
     * @var \Digital\Productenquiry\Model\ProductenquiryFactory
     */
    protected $_productenquiryCollectionFactory;
    
    /** @var \Digital\Productenquiry\Helper\Data */
    protected $_dataHelper;
    protected $directoryBlock;

    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Digital\Productenquiry\Model\ResourceModel\Productenquiry\CollectionFactory $productenquiryCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Digital\Productenquiry\Model\ResourceModel\Productenquiry\CollectionFactory $productenquiryCollectionFactory,
        \Digital\Productenquiry\Helper\Data $dataHelper,
        \Magento\Directory\Block\Data $directoryBlock, 
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->_productenquiryCollectionFactory = $productenquiryCollectionFactory;
        $this->_dataHelper = $dataHelper;
        $this->directoryBlock = $directoryBlock;
        $this->registry = $registry;
        $this->customerSession = $customerSession;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve productenquiry collection
     *
     * @return Digital\Productenquiry\Model\ResourceModel\Productenquiry\Collection
     */

public function getCountries()
    {
        $country = $this->directoryBlock->getCountryHtmlSelect();
        return $country;
    }

    public function getRegion()
    {
        $region = $this->directoryBlock->getRegionHtmlSelect();
        return $region;
    }

    public function getStateChangeAjaxUrl(){
        return $this->getUrl("productenquiry/region/index"); // Controller Url
    }

     public function getFormAction(){
        return $this->getUrl("productenquiry/index/post"); // Controller Url
    }

     public function getCurrentProductId(){
        return 0;//$this->registry->registry('current_product')->getId();
    }

    public function getCurrentProductName(){
        return "";//$this->registry->registry('current_product')->getName();
    }
    public function getCurrentProductSku(){
        return "";//$this->registry->registry('current_product')->getSku();
    }
    public function getCustomerName(){
        return $this->customerSession->getCustomer()->getName();
    }
    public function getCustomerEmail(){
        return $this->customerSession->getCustomer()->getEmail();
    }
  
    public function isLoggedIn(){
        return $this->customerSession->isLoggedIn();
    }
    
     public function isCaptchaEnable()
    {
         return $this->_dataHelper->getCaptchaEnable();
    }

     public function isEnabledModule()
    {
         return $this->_dataHelper->isEnabled();
    }
    protected function _getCollection()
    {
        $collection = $this->_productenquiryCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared productenquiry collection
     *
     * @return Digital\Productenquiry\Model\ResourceModel\Productenquiry\Collection
     */
    public function getCollection()
    {
        if (is_null($this->_productenquiryCollection)) {
            $this->_productenquiryCollection = $this->_getCollection();
            $this->_productenquiryCollection->setCurPage($this->getCurrentPage());
            $this->_productenquiryCollection->setPageSize($this->_dataHelper->getProductenquiryPerPage());
            $this->_productenquiryCollection->setOrder('published_at','asc');
        }

        return $this->_productenquiryCollection;
    }
    
    /**
     * Fetch the current page for the productenquiry list
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    
    /**
     * Return URL to item's view page
     *
     * @param Digital\Productenquiry\Model\Productenquiry $productenquiryItem
     * @return string
     */
    public function getItemUrl($productenquiryItem)
    {
        return $this->getUrl('*/*/view', array('id' => $productenquiryItem->getId()));
    }
    
    /**
     * Return URL for resized Productenquiry Item image
     *
     * @param Digital\Productenquiry\Model\Productenquiry $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }
    
    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChildBlock('productenquiry_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $productenquiryPerPage = $this->_dataHelper->getProductenquiryPerPage();

            $pager->setAvailableLimit([$productenquiryPerPage => $productenquiryPerPage]);
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(TRUE);
            $pager->setFrameLength(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            )->setJump(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame_skip',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );

            return $pager->toHtml();
        }

        return NULL;
    }
}
