<?php
namespace Digital\Foodneeds\Model;

class Foodneeds extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Digital\Foodneeds\Model\ResourceModel\Foodneeds');
    }
}
?>
