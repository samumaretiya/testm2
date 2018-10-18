<?php
namespace Digital\Foodneeds\Block\Adminhtml\Foodneeds\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('foodneeds_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Food Need Information'));
    }
}


