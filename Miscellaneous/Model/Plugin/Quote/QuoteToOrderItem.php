<?php
namespace Digital\Miscellaneous\Model\Plugin\Quote;

use Closure;

class QuoteToOrderItem
{
  public function aroundConvert(
        \Magento\Quote\Model\Quote\Item\ToOrderItem $subject,
        Closure $proceed,
        \Magento\Quote\Model\Quote\Item\AbstractItem $item,
        $additional = []
    ) {
        $orderItem = $proceed($item, $additional);
	  	$orderItem->setAdults($item->getAdults());
		$orderItem->setCruisename($item->getCruisename());
		$orderItem->setBookingdate($item->getBookingdate());
		$orderItem->setStarttime($item->getStarttime());
		$orderItem->setEndtime($item->getEndtime());
        return $orderItem;
    }
}

?>