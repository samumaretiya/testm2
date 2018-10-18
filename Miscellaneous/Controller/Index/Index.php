<?php

namespace Digital\Miscellaneous\Controller\Index;
use Magento\Framework\App\ResourceConnection;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_resultJsonFactory;
    
    protected $_dataObjectFactory;
    
    protected $_jsonHelper;
    
    protected $_checkoutSession;
    
	protected $_urlBuilder;
	
	protected $_resourceConnection;

	protected $_connection;
	
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
     	\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\DataObjectFactory $dataObjectFactory,
		\Magento\Checkout\Model\Session $checkoutSession,
		\Magento\Framework\App\ResourceConnection $resourceConnection,
		\Magento\Framework\UrlInterface $urlBuilder,
        array $data = []
	) {
       
        parent::__construct($context);
        $this->_dataObjectFactory = $dataObjectFactory;
        $this->_jsonHelper = $jsonHelper;
		$this->_resultJsonFactory = $resultJsonFactory;
		$this->_checkoutSession = $checkoutSession;
		$this->_urlBuilder = $urlBuilder;
		$this->_resourceConnection = $resourceConnection;
		$this->_connection = $this->_resourceConnection->getConnection();
    }
	
    public function execute()
    {
		$producttype  = $this->getRequest()->getParam('producttype');
    	$date_of_tour = $this->getRequest()->getParam('date_of_tour');
		$parentId 	  = $this->getRequest()->getParam('productid');
		
		if($producttype == "standalone")
		{
			$blockoutdates 		= $this->_resourceConnection->getTableName('blockoutdates');
			$checkblocking 		= "Select * FROM ".$blockoutdates." where product_id =".$parentId;
			$blockoutdatesData  =  $this->_connection->fetchAll($checkblocking);
			if(count($blockoutdatesData))
			{
				foreach($blockoutdatesData as $key => $value)
				{
					if(strtotime($date_of_tour) == strtotime($value['blocked_dates']))
					{
						$result['child'] = '';	
						$resultJson = $this->_resultJsonFactory->create();
						return $resultJson->setData($result);
					}
				}
			}
			$result['child'] = $parentId;	
			$resultJson = $this->_resultJsonFactory->create();
			return $resultJson->setData($result);
		}
		else
		{
			$tourId 	  = $this->getRequest()->getParam('tourname');

			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$childrenIds  = $objectManager->create('Magento\GroupedProduct\Model\Product\Type\Grouped')->getChildrenIds($parentId);

			$_hasAssociatedProducts = count($childrenIds) > 0;

			$shouldShowTour = true; 
			if ($_hasAssociatedProducts)
			{
				foreach ($childrenIds as $items)
				{
					foreach ($items as $key=>$value)
					{
						if($value == $tourId)
						{
							$blockoutdates = $this->_resourceConnection->getTableName('blockoutdates');
							$checkblocking 		= "Select * FROM ".$blockoutdates." where product_id =".$tourId;
							$blockoutdatesData  =  $this->_connection->fetchAll($checkblocking);
							if(count($blockoutdatesData))
							{
								foreach($blockoutdatesData as $key => $value)
								{
									if(strtotime($date_of_tour) == strtotime($value['blocked_dates']))
									{
										$result['child'] = '';	
										$resultJson = $this->_resultJsonFactory->create();
										return $resultJson->setData($result);
									}
								}
							}
							$result['child'] = $tourId;	
							$resultJson = $this->_resultJsonFactory->create();
							return $resultJson->setData($result);
						}
					}
				}
			}
			else
			{
				$result['child'] = '';	
				$resultJson = $this->_resultJsonFactory->create();
				return $resultJson->setData($result);
			}
		}
    }
	
}
?>
