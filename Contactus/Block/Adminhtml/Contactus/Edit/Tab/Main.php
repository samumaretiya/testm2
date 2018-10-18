<?php
namespace Digital\Contactus\Block\Adminhtml\Contactus\Edit\Tab;

/**
 * Cms page edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('contactus');

        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('Digital_Contactus::save')) {
            $isElementDisabled = false;
			$isDisabled = false;
        } else {
            $isElementDisabled = true;
			$isDisabled = false;
        }

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('contactus_main_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Contact Enquiries Information')]);

        if ($model->getId()) {
            $fieldset->addField('contactus_id', 'hidden', ['name' => 'contactus_id']);
        }

        if ($model->getName()) {
            $fieldset->addField('name','label',
                [
                    'name' => 'name',
                    'label' => __('First Name:'),
                    'title' => __('First Name'),                
                    'disabled' => $isElementDisabled
                ]
            );
        }
		
		if ($model->getName()) {
            $fieldset->addField('last_name','label',
                [
                    'name' => 'last_name',
                    'label' => __('Last Name:'),
                    'title' => __('Last Name'),                
                    'disabled' => $isElementDisabled
                ]
            );
        }
		
		if ($model->getEmail()) {
    		$fieldset->addField('email','label',
                [
                    'name' => 'email',
                    'label' => __('Email:'),
                    'title' => __('Email'),                
                    'disabled' => $isElementDisabled
                ]
            );
        }
        
        

        if ($model->getContact()) {
            $fieldset->addField('contact','label',
                [
                    'name' => 'contact',
                    'label' => __('Contact No:'),
                    'title' => __('Contact No'),                
                    'disabled' => $isElementDisabled
                ]
            );
        }
		
		if ($model->getContact()) {
            $fieldset->addField('enquiry_type','label',
                [
                    'name' => 'enquiry_type',
                    'label' => __('Enquiry Type:'),
                    'title' => __('Enquiry Type'),                
                    'disabled' => $isElementDisabled
                ]
            );
        }
		
		if ($model->getContact()) {
            $fieldset->addField('occasion','label',
                [
                    'name' => 'occasion',
                    'label' => __('Occasion:'),
                    'title' => __('Occasion'),                
                    'disabled' => $isElementDisabled
                ]
            );
        }

        

        if ($model->getMessage()) {
    		$fieldset->addField('message','label',
                [
                    'name' => 'message',
                    'label' => __('Comment:'),
                    'title' => __('Comment'),                
                    'disabled' => $isElementDisabled
                ]
            );
        }
		
		
		/*$fieldset->addField(
            'receive_newsletter',
            'select',
            [
				'name' => 'receive_newsletter',
                'label' => __('Receive Newsletters:'),
                'title' => __('Receive Newsletters'),                
                'required' => false,				
               	'values' => array(
                	array('value'=>'1','label'=>'Yes'),
                    array('value'=>'','label'=>'No'),                            
                 ),
				 'disabled' => $isElementDisabled,
							
            ]
        );*/
		
		
		$this->_eventManager->dispatch('adminhtml_contactus_edit_tab_main_prepare_form', ['form' => $form]);

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Contact Enquiries Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Contact Enquiries Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
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
