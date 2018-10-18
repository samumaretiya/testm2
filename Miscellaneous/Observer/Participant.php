<?php
    
namespace Digital\Miscellaneous\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class Participant implements ObserverInterface
{
	protected $_request;
	
	public function __construct(
    	\Magento\Framework\App\RequestInterface $request
	)
	{
		$this->_request = $request;
	}
	
	public function execute(\Magento\Framework\Event\Observer $observer) 
	{
		$item 	= $observer->getEvent()->getData('quote_item');         
		$item 	= ( $item->getParentItem() ? $item->getParentItem() : $item );
		$price 	= $item->getProduct()->getId();
		
		$adults 	= (int)$this->_request->getParam('adults'); 
		$kids 		= $this->_request->getParam('kids'); 
		$concession = $this->_request->getParam('concession'); 
		$family 	= $this->_request->getParam('family'); 
		$date_of_tour = $this->_request->getParam('date_of_tour'); 
		$date_of_tour = str_replace("/","-",$date_of_tour);
		$starttime 	= $this->_request->getParam('starttime');
		$endtime 	= $this->_request->getParam('endtime');
		$choice_of_entree = $this->_request->getParam('choice_of_entree');
		$choice_of_main_course = $this->_request->getParam('choice_of_main_course');
		
		$tourTotalCosting = 0;
		
		$item->setCruisename($item->getName());
		
		if($date_of_tour != "")
		{
			$item->setBookingdate($date_of_tour);
		}
		
		if($adults != "")
		{
			$item->setAdults($adults);
			$singleAdultPrice = (int)$this->_request->getParam('adultsprice'); 
			$totalAdultCost   =  $adults * $singleAdultPrice;
			$tourTotalCosting += $totalAdultCost;
		}
		
		if($kids != "")
		{
			$item->setKids($kids);
			$singleKidsPrice = (int)$this->_request->getParam('kidsprice'); 
			$totalKidsCost   =  $kids * $singleKidsPrice;
			$tourTotalCosting += $totalKidsCost;
		}
		
		if($concession != "")
		{
			$item->setConcession($concession);
			$singleconcessionPrice = (int)$this->_request->getParam('concession'); 
			$totalconcessionCost   =  $concession * $singleconcessionPrice;
			$tourTotalCosting += $totalconcessionCost;
		}
		
		if($family != "")
		{
			$item->setFamily($family);
			$singlefamilyPrice = (int)$this->_request->getParam('family'); 
			$totalfamilyCost   =  $family * $singlefamilyPrice;
			$tourTotalCosting += $totalfamilyCost;
		}

		if($starttime != "")
		{
			$item->setStarttime($starttime);
		}
		
		if($endtime != "")
		{
			$item->setEndtime($endtime);
		}
		
		if($choice_of_entree != "")
		{
			$item->setEntree($choice_of_entree);
		}
		
		if($choice_of_main_course != "")
		{
			$item->setMaincourse($choice_of_main_course);
		}
		
		$item->setCustomPrice($tourTotalCosting);
		$item->setOriginalCustomPrice($tourTotalCosting);
		$item->getProduct()->setIsSuperMode(true);
	}
}

?>