<?php

namespace Digital\Faqs\Model\ResourceModel\Faqs;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Digital\Faqs\Model\Faqs', 'Digital\Faqs\Model\ResourceModel\Faqs');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>
