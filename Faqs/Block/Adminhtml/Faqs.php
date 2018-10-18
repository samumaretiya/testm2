<?php
/**
 * Adminhtml warehouse list block
 *
 */
namespace Digital\Faqs\Block\Adminhtml;

class Faqs extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_faqs';
        $this->_blockGroup = 'Digital_Faqs';
        $this->_headerText = __('Faqs');
        $this->_addButtonLabel = __('Add New Faqs');
        parent::_construct();
        if ($this->_isAllowedAction('Digital_Faqs::save')) {
            $this->buttonList->update('add', 'label', __('Add New FAQ'));
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
