<?php

namespace Digital\Foodneeds\Block\Adminhtml\Foodneeds\Edit\Tab;
use Magento\Cms\Model\Wysiwyg\Config;
/**
 * Foodneeds edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected $_wysiwygConfig;
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Digital\Foodneeds\Model\Status
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
        \Digital\Foodneeds\Model\Status $status,
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
        /* @var $model \Digital\Foodneeds\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('foodneeds');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Food Need Information')]);

        if ($model->getId()) {
            $fieldset->addField('foodneed_id', 'hidden', ['name' => 'foodneed_id']);
        }

		$fieldset->addField(
            'choice_of_entree',
            'text',
            [
                'name' => 'choice_of_entree',
                'label' => __('Choice Of Entree'),
                'title' => __('Choice Of Entree'),
				'required' => false,
                'disabled' => $isElementDisabled
            ]
        );
		
		$fieldset->addField(
            'choice_of_main_course',
            'text',
            [
                'name' => 'choice_of_main_course',
                'label' => __('Choice Of Main Course'),
                'title' => __('Choice Of Main Course'),
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
                'options' => \Digital\Foodneeds\Block\Adminhtml\Foodneeds\Grid::getOptionArray3(),
                'disabled' => $isElementDisabled
            ]
        );
        /*$wysiwygConfig = $this->_wysiwygConfig->getConfig();				
        $fieldset->addField(
            'choice_of_main_course',
            'editor',
            [
                'name' => 'choice_of_main_course',
                'style'     => 'width:700px; height:500px;',
                'label' => __('Choice Of Main Course'),
                'title' => __('Choice Of Main Course'),
				'required' => true,
                'disabled' => $isElementDisabled,
                'config' => $wysiwygConfig 
            ]
        );
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
        );*/
        /*$fieldset->addField(
            'foodneed_type',
            'select',
            [
                'label' => __('Foodneed Type'),
                'title' => __('Foodneed Type'),
                'name' => 'foodneed_type',				
                'options' => $this->_status->getFoodneedTypeArray() 
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
        return __('Food Need Information');
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
