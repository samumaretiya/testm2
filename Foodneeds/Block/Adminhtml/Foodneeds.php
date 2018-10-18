<?php
/**
 * Adminhtml warehouse list block
 *
 */
namespace Digital\Foodneeds\Block\Adminhtml;

class Foodneeds extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_foodneeds';
        $this->_blockGroup = 'Digital_Foodneeds';
        $this->_headerText = __('Foodneeds');
        $this->_addButtonLabel = __('Add New Foodneeds');
        parent::_construct();
        if ($this->_isAllowedAction('Digital_Foodneeds::save')) {
            $this->buttonList->update('add', 'label', __('Add New Food Need'));
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
