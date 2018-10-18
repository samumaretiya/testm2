<?php
namespace Digital\Faqs\Model;

class Faqs extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Digital\Faqs\Model\ResourceModel\Faqs');
    }
}
?>
