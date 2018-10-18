<?php

namespace Digital\Faqs\Block\Adminhtml\Faqs\Edit\Tab;
use Magento\Cms\Model\Wysiwyg\Config;
/**
 * Faqs edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected $_wysiwygConfig;
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Digital\Faqs\Model\Status
     */
    protected $_status;

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
         Config $wysiwygConfig,
        \Digital\Faqs\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Digital\Faqs\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('faqs');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('FAQ Information')]);

        if ($model->getId()) {
            $fieldset->addField('faq_id', 'hidden', ['name' => 'faq_id']);
        }

		$fieldset->addField(
            'question',
            'text',
            [
                'name' => 'question',
                'label' => __('Question'),
                'title' => __('Question'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );				
		$wysiwygConfig = $this->_wysiwygConfig->getConfig();				
        $fieldset->addField(
            'answer',
            'editor',
            [
                'name' => 'answer',
                'style'     => 'width:700px; height:500px;',
                'label' => __('Answer'),
                'title' => __('Answer'),
				'required' => true,
                'disabled' => $isElementDisabled,
                'config' => $wysiwygConfig 
            ]
        );
		/*$wysiwygConfig = $this->_wysiwygConfig->getConfig();*/		
        $fieldset->addField(
            'rank',
            'text',
            [
                'name' => 'rank',
                'label' => __('Rank'),
                'title' => __('Rank'),
				'required' => false,
                'disabled' => $isElementDisabled
            ]
        );			
        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',				
                'options' => \Digital\Faqs\Block\Adminhtml\Faqs\Grid::getOptionArray3(),
                'disabled' => $isElementDisabled
            ]
        );
        
        /*$fieldset->addField(
            'faq_type',
            'select',
            [
                'label' => __('Faq Type'),
                'title' => __('Faq Type'),
                'name' => 'faq_type',				
                'options' => $this->_status->getFaqTypeArray() 
            ]
        );*/
						
						

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('FAQ Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
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
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
