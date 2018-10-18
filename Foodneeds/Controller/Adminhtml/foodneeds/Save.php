<?php
namespace Digital\Foodneeds\Controller\Adminhtml\foodneeds;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action {
    /**
     * @param Action\Context $context
	 @var PostDataProcessor
     */
	 protected $date;
	 protected $dataProcessor;
	 
    public function __construct(Action\Context $context, \Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor $dataProcessor,\Magento\Framework\Stdlib\DateTime\DateTime $date) {
        $this->dataProcessor = $dataProcessor;
		$this->date = $date;
		parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
		
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
			$data = $this->dataProcessor->filter($data);
            $model = $this->_objectManager->create('Digital\Foodneeds\Model\Foodneeds');
			
            $id = $this->getRequest()->getParam('foodneed_id');
			
            if ($id) {
                $model->load($id);
                //$model->setCreatedAt(date('Y-m-d H:i:s'));
            }
			
			if ($model->getCreatedTime() == NULL && $model->getUpdatedTime() == NULL) {
				$data['created_time'] = $this->date->gmtDate();
				$data['updated_time'] = $this->date->gmtDate();
			} else {
				$data['updated_time'] = $this->date->gmtDate();
			}
			
			$data['choice_of_entree'] = trim($this->getRequest()->getParam('choice_of_entree'));			
			$data['choice_of_main_course'] = trim($this->getRequest()->getParam('choice_of_main_course'));
						
			try{
				$uploader = $this->_objectManager->create(
					'Magento\MediaStorage\Model\File\Uploader',
					['fileId' => 'image']
				);
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);				
				$imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(true);				
				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
					->getDirectoryRead(DirectoryList::MEDIA);
				$result = $uploader->save($mediaDirectory->getAbsolutePath('foodneeds_image'));
					if($result['error']==0)
					{
						$data['image'] = 'foodneeds_image' . $result['file'];
					}
			} catch (\Exception $e) {
				//unset($data['image']);
            }
			
			//var_dump($data);die;
			if(isset($data['image']['delete']) && $data['image']['delete'] == '1')
				$data['image'] = '';
			
            //$model->setData($data);
			 $model->addData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Foodneed has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['foodneed_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Foodneeds.'));
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);

            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['foodneed_id' => $this->getRequest()->getParam('foodneed_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
