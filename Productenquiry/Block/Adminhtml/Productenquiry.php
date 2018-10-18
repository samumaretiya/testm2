<?php
/**
 * Adminhtml productenquiry list block
 *
 */
namespace Digital\Productenquiry\Block\Adminhtml;

class Productenquiry extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_productenquiry';
        $this->_blockGroup = 'Digital_Productenquiry';
        $this->_headerText = __('Product Enquiries');
        $this->_addButtonLabel = __('Add New Productenquiry');
        parent::_construct();
        if ($this->_isAllowedAction('Digital_Productenquiry::save')) {
            //$this->buttonList->update('add', 'label', __('Add New Productenquiry'));
             $this->buttonList->remove('add');
        } else {
            $this->buttonList->remove('add');
        }
    }
    
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
