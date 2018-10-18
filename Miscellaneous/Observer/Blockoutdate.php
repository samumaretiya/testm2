<?php
    
namespace Digital\Miscellaneous\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\RequestInterface;

class Blockoutdate implements ObserverInterface
{
	protected $_request;
	
	protected $_resourceConnection;

	protected $_connection;
	
	public function __construct(
    	\Magento\Framework\App\RequestInterface $request,
		\Magento\Framework\App\ResourceConnection $resourceConnection
	)
	{
		$this->_request = $request;
		$this->_resourceConnection = $resourceConnection;
		$this->_connection = $this->_resourceConnection->getConnection();
  
	}
	public function execute(\Magento\Framework\Event\Observer $observer) 
	{
		$_product 			  = $observer->getProduct();
		$_productId	  		  = $_product->getId();

		if($_product->getSelectDateToBlock() != "" && $_productId != "")
		{
			$select_date_to_block = date('Y-m-d',strtotime($_product->getSelectDateToBlock()));
			
			$blockoutdates = $this->_resourceConnection->getTableName('blockoutdates');
			$checkexisting 		= "Select * FROM ".$blockoutdates." where product_id =".$_productId;
			$blockoutdatesData  =  $this->_connection->fetchAll($checkexisting);
			
			$shouldSave = true;
			if(count($blockoutdatesData))
			{
				foreach($blockoutdatesData as $key => $value)
				{
					if(strtotime($select_date_to_block) == strtotime($value['blocked_dates']))
					{
						$shouldSave = false;
					}
				}
			}
			if($shouldSave)
			{
				$sql = "INSERT INTO `".$blockoutdates."` (`entity_id`, `product_id`, `blocked_dates`) VALUES (NULL, '".$_productId."', '".$select_date_to_block."');";
				$this->_connection->query($sql);
			}
		}
	}
}

?>