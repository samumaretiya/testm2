<?php

namespace Digital\Contactus\Block\Adminhtml\Form\Element;

class Image extends \Magento\Framework\Data\Form\Element\Image
{ 
    
    protected function _getUrl()
    {
        return $this->getValue();
    }
}
