<?php
    
namespace Digital\Miscellaneous\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

use Psr\Log\LoggerInterface as Logger;

class OrderPlaceAfter implements ObserverInterface
{
	public function __construct(
        Logger $logger
    ) {
        $this->_logger = $logger;
    }
	public function execute(\Magento\Framework\Event\Observer $observer) 
	{
		 $order = $observer->getEvent()->getOrder();
		 $items = $order->getAllVisibleItems();
		 foreach($items as $item){
			$order->setAdults($item->getAdults());
			$item->setKids($item->getKids());
			$item->setConcession($item->getConcession());
			$item->getFamily($item->getFamily()); 
			$order->setCruisename($item->getCruisename());
			$order->setBookingdate($item->getBookingdate());
			$order->setStarttime($item->getStarttime());
			$order->setEndtime($item->getEndtime());
		 }
	}
}

?>