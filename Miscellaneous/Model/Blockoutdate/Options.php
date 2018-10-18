<?php
namespace Digital\Miscellaneous\Model\Blockoutdate;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResourceConnection;

class Options implements \Magento\Framework\Option\ArrayInterface
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
	
    public function toOptionArray()
    {
		$productId = $this->_request->getParam('id');
		$blockData = array();
		
		if($productId != "")
		{
			$blockoutdates = $this->_connection->getTableName('blockoutdates');
			$sql = "Select * FROM " . $blockoutdates." where product_id = ".$productId;
			$blockoutdatesData = $this->_connection->fetchAll($sql);

			

			foreach($blockoutdatesData as $key => $value)
			{
					array_push(
							$blockData,
							array(
									'value'=> $value['entity_id'],
									'label'=> $value['blocked_dates']
								 )
						  );
			}
		}

		return $blockData;
    }
}

?>