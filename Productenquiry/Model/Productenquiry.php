<?php

namespace Digital\Productenquiry\Model;

/**
 * Productenquiry Model
 *
 * @method \Digital\Productenquiry\Model\Resource\Page _getResource()
 * @method \Digital\Productenquiry\Model\Resource\Page getResource()
 */
class Productenquiry extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Digital\Productenquiry\Model\ResourceModel\Productenquiry');
    }

}
