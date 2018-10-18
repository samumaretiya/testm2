<?php
namespace Digital\Productenquiry\Block\Adminhtml\Productenquiry\Edit\Tab;

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
        $model = $this->_coreRegistry->registry('productenquiry');

        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('Digital_Productenquiry::save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('productenquiry_main_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Product Enquiry Information')]);

        if ($model->getId()) {
            $fieldset->addField('productenquiry_id', 'hidden', ['name' => 'productenquiry_id']);
        }

        $fieldset->addField(
            'productname',
            'label',
            [
                'name' => 'productname',
                'label' => __('Product Name:'),
                'title' => __('Product Name:'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'productsku',
            'label',
            [
                'name' => 'productsku',
                'label' => __('Product SKU:'),
                'title' => __('Product SKU'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );


        $fieldset->addField(
            'name',
            'label',
            [
                'name' => 'name',
                'label' => __('First Name:'),
                'title' => __('First Name'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
		
		$fieldset->addField(
            'last_name',
            'label',
            [
                'name' => 'last_name',
                'label' => __('Last Name:'),
                'title' => __('Last Name'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
		
		$fieldset->addField(
            'telephone',
            'label',
            [
                'name' => 'telephone',
                'label' => __('Contact No:'),
                'title' => __('Contact No'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );


        $fieldset->addField(
            'email',
            'label',
            [
                'name' => 'email',
                'label' => __('Email:'),
                'title' => __('Email'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
		
		$fieldset->addField(
            'expecteddate',
            'label',
            [
                'name' => 'expecteddate',
                'label' => __('Expected Date:'),
                'title' => __('Expected Date'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
		
		$fieldset->addField(
            'expected_people',
            'label',
            [
                'name' => 'expected_people',
                'label' => __('Expected No. of People:'),
                'title' => __('Expected No. of People'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
		
		$fieldset->addField(
            'occasion',
            'label',
            [
                'name' => 'occasion',
                'label' => __('Occasion:'),
                'title' => __('Occasion'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );



        $fieldset->addField(
            'comment',
            'label',
            [
                'name' => 'comment',
                'label' => __('Comment:'),
                'title' => __('Comment:'),
                'required' => false,
                'disabled' => $isElementDisabled
            ]
        );


     

        
       /* $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $fieldset->addField('published_at', 'date', [
            'name'     => 'published_at',
            'date_format' => $dateFormat,
            'image'    => $this->getViewFileUrl('images/grid-cal.gif'),
            'value' => $model->getPublishedAt(),
            'label'    => __('Publishing Date'),
            'title'    => __('Publishing Date'),
            'required' => true
        ]);*/
        
        $this->_eventManager->dispatch('adminhtml_productenquiry_edit_tab_main_prepare_form', ['form' => $form]);

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
        return __('Product Enquiry');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Product Enquiry');
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
