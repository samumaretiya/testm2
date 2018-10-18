<?php
namespace Digital\Productenquiry\Block\Adminhtml\Productenquiry;

/**
 * Adminhtml Productenquiry grid
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Digital\Productenquiry\Model\ResourceModel\Productenquiry\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var \Digital\Productenquiry\Model\Productenquiry
     */
    protected $_productenquiry;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Digital\Productenquiry\Model\Productenquiry $productenquiryPage
     * @param \Digital\Productenquiry\Model\ResourceModel\Productenquiry\CollectionFactory $collectionFactory
     * @param \Magento\Core\Model\PageLayout\Config\Builder $pageLayoutBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Digital\Productenquiry\Model\Productenquiry $productenquiry,
        \Digital\Productenquiry\Model\ResourceModel\Productenquiry\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_productenquiry = $productenquiry;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('productenquiryGrid');
        $this->setDefaultSort('productenquiry_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection
     *
     * @return \Magento\Backend\Block\Widget\Grid
     */
    protected function _prepareCollection()
    {
        $collection = $this->_collectionFactory->create();
        /* @var $collection \Digital\Productenquiry\Model\ResourceModel\Productenquiry\Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn('productenquiry_id', [
            'header'    => __('ID'),
            'index'     => 'productenquiry_id',
        ]);
        
        $this->addColumn('productname', ['header' => __('Product Name'), 'index' => 'productname']);
        $this->addColumn('productsku', ['header' => __('Product SKU'), 'index' => 'productsku']);
        $this->addColumn('name', ['header' => __('First Name'), 'index' => 'name']);
        $this->addColumn('last_name', ['header' => __('Last Name'), 'index' => 'last_name']);
        $this->addColumn('email', ['header' => __('Email ID'), 'index' => 'email']);               
        $this->addColumn('telephone', ['header' => __('Contact No'), 'index' => 'telephone']);               
      
        
        
        $this->addColumn('action', ['header' => __('Action'), 'index' => 'action']);
        $this->addColumn(
            'action',
            [
                'header' => __('Action'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('View'),
                        'url' => [
                            'base' => '*/*/edit',
                            'params' => ['store' => $this->getRequest()->getParam('store')]
                        ],
                        'field' => 'productenquiry_id'
                    ]
                ],
                'sortable' => false,
                'filter' => false,
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );

        return parent::_prepareColumns();
    }
	
	protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('productenquiry_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('contactus/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );
        return $this;
    }

    /**
     * Row click url
     *
     * @param \Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['productenquiry_id' => $row->getId()]);
    }

    /**
     * Get grid url
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
