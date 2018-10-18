<?php
namespace Digital\Faqs\Model\ResourceModel;

class Faqs extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faq', 'faq_id');
    }
}
?>
