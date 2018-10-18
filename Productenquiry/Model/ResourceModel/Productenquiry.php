<?php

namespace Digital\Productenquiry\Model\ResourceModel;

/**
 * Productenquiry Resource Model
 */
class Productenquiry extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('digital_productenquiry', 'productenquiry_id');
    }
}
