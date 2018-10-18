<?php

namespace Digital\Foodneeds\Model\ResourceModel\Foodneeds;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Digital\Foodneeds\Model\Foodneeds', 'Digital\Foodneeds\Model\ResourceModel\Foodneeds');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>
