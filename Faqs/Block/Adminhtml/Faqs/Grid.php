<?php
namespace Digital\Faqs\Block\Adminhtml\Faqs;


class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
	  
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Digital\Faqs\Model\faqsFactory
     */
    protected $_faqsFactory;

    /**
     * @var \Digital\Faqs\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Digital\Faqs\Model\faqsFactory $faqsFactory
     * @param \Digital\Faqs\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Digital\Faqs\Model\FaqsFactory $FaqsFactory,
        \Digital\Faqs\Model\Status $status,
        
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_faqsFactory = $FaqsFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
      
        parent::__construct($context, $backendHelper, $data);
       
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('faq_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_faqsFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'faq_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'faq_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'question',
					[
						'header' => __('Question'),
						'index' => 'question',
					]
				);
			
				/*$this->addColumn(
					'answer',
					[
						'header' => __('Answer'),
						'index' => 'answer',
						
					]
				); */
				$this->addColumn(
					'rank',
					[
						'header' => __('Rank'),
						'index' => 'rank',
						
					]
				);	
				$this->addColumn(
					'status',
					[
						'header' => __('Status'),
						'index' => 'status',
						'type' => 'options',
						'options' => \Digital\Faqs\Block\Adminhtml\Faqs\Grid::getOptionArray3()
					]
				); 
				/*$this->addColumn(
					'faq_type',
					[
						'header' => __('Faq Type'),
						'index' => 'faq_type',
						'type' => 'options',
						'options' => $this->_status->getFaqTypeArray()
					]
				);*/
			$this->addExportType($this->getUrl('faqs/*/exportCsv', ['_current' => true]),__('CSV'));
		    $this->addExportType($this->getUrl('faqs/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('faq_id');
        
        $this->getMassactionBlock()->setFormFieldName('faqs');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('faqs/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('faqs/*/index', ['_current' => true]);
    }

    /**
     * @param \Digital\Faqs\Model\faqs|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'faqs/*/edit',
            ['faq_id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray3()
		{
            $data_array=array(); 
			$data_array[0]='Enable';
			$data_array[1]='Disable';
            return($data_array);
		}
		static public function getValueArray3()
		{
            $data_array=array();
			foreach(\Digital\Faqs\Block\Adminhtml\Faqs\Grid::getOptionArray3() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}
