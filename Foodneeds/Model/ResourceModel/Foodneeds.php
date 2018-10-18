<?php
namespace Digital\Foodneeds\Model\ResourceModel;

class Foodneeds extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('foodneed', 'foodneed_id');
    }
}
?>
