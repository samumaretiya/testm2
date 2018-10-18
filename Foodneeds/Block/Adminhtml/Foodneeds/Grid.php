<?php
namespace Digital\Foodneeds\Block\Adminhtml\Foodneeds;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended {	  
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;
    /**
     * @var \Digital\Foodneeds\Model\foodneedsFactory
     */
    protected $_foodneedsFactory;
    /**
     * @var \Digital\Foodneeds\Model\Status
     */
    protected $_status;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Digital\Foodneeds\Model\foodneedsFactory $foodneedsFactory
     * @param \Digital\Foodneeds\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Digital\Foodneeds\Model\FoodneedsFactory $FoodneedsFactory,
        \Digital\Foodneeds\Model\Status $status,
        
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_foodneedsFactory = $FoodneedsFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
      
        parent::__construct($context, $backendHelper, $data);       
    }

    /**
     * @return void
     */
    protected function _construct() {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('foodneed_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }
    /**
     * @return $this
     */
    protected function _prepareCollection() {
        $collection = $this->_foodneedsFactory->create()->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }
    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns() {
        $this->addColumn(
            'foodneed_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'foodneed_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );
		$this->addColumn(
			'choice_of_entree',
			[
				'header' => __('Choice Of Entree'),
				'index' => 'choice_of_entree',
			]
		);
	
		$this->addColumn(
			'choice_of_main_course',
			[
				'header' => __('Choice Of Main Course'),
				'index' => 'choice_of_main_course',
				
			]
		);
		$this->addColumn(
			'status',
			[
				'header' => __('Status'),
				'index' => 'status',
				'type' => 'options',
				'options' => \Digital\Foodneeds\Block\Adminhtml\Foodneeds\Grid::getOptionArray3()
			]
		);
		/*$this->addColumn(
			'rank',
			[
				'header' => __('Rank'),
				'index' => 'rank',
				
			]
		);*/			
		/*$this->addColumn(
			'foodneed_type',
			[
				'header' => __('Foodneed Type'),
				'index' => 'foodneed_type',
				'type' => 'options',
				'options' => $this->_status->getFoodneedTypeArray()
			]
		);*/
		$this->addExportType($this->getUrl('foodneeds/*/exportCsv', ['_current' => true]),__('CSV'));
		$this->addExportType($this->getUrl('foodneeds/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }
        return parent::_prepareColumns();
    }
	
    /**
     * @return $this
     */
    protected function _prepareMassaction() {
        $this->setMassactionIdField('foodneed_id');        
        $this->getMassactionBlock()->setFormFieldName('foodneeds');
        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('foodneeds/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );
        $statuses = $this->_status->getOptionArray();
        return $this;
    }
    /**
     * @return string
     */
    public function getGridUrl() {
        return $this->getUrl('foodneeds/*/index', ['_current' => true]);
    }
    /**
     * @param \Digital\Foodneeds\Model\foodneeds|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row) {		
        return $this->getUrl(
            'foodneeds/*/edit',
            ['foodneed_id' => $row->getId()]
        );		
    }
	
	static public function getOptionArray3() {
		$data_array=array(); 
		$data_array[0]='Enable';
		$data_array[1]='Disable';
		return($data_array);
	}
	static public function getValueArray3() {
		$data_array=array();
		foreach(\Digital\Foodneeds\Block\Adminhtml\Foodneeds\Grid::getOptionArray3() as $k=>$v){
		   $data_array[]=array('value'=>$k,'label'=>$v);		
		}
		return($data_array);
	}
}