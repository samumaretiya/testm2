<?php

/**
 * Productenquiry Resource Collection
 */
namespace Digital\Productenquiry\Model\ResourceModel\Productenquiry;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Digital\Productenquiry\Model\Productenquiry', 'Digital\Productenquiry\Model\ResourceModel\Productenquiry');
    }
}
