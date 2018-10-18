<?php

namespace Digital\Productenquiry\Controller\Index;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\Model\AbstractModel;
class Post extends  \Magento\Framework\App\Action\Action
{

 protected $productenquiryHelper;

   public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory    $resultJsonFactory,
        \Magento\Directory\Model\RegionFactory $regionColFactory,
        \Magento\Directory\Model\Country $countryColFactory,
        \Digital\Productenquiry\Helper\Data $productenquiryHelper,
        PageFactory $resultPageFactory
    ) {        
        $this->regionColFactory     = $regionColFactory;
        $this->resultJsonFactory    = $resultJsonFactory;
        $this->countryColFactory    = $countryColFactory;
        $this->_productenquiryHelper = $productenquiryHelper;
        parent::__construct($context);
    }



	public function execute()
    {
        

         $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);   
		 
		 $post = $this->getRequest()->getPostValue();	
		


	   
		if (!$post) {
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            
        }
		

        
		
		
            	//if(trim($post['g-recaptcha-response']) =='')
                //{              
              //      $this->messageManager->addError('Please check captcha check box if you want to Process.');             
             //        $this->_redirect('*/*/');
             //        return;
              //  }
       
		
				
			 $postObject = new \Magento\Framework\DataObject();
             $postObject->setData($post);
			
				$productname   = trim($post['productname']);
                $productsku   = trim($post['productsku']);
                $name           = trim($post['name']);
                $last_name           = trim($post['last_name']);
                $telephone           = trim($post['telephone']);
                $email           = trim($post['email']);
                $expecteddate           = trim($post['expecteddate']);
                $expected_people           = trim($post['expected_people']);                
                $occasion           = trim($post['occasion']);                
                $comment        = trim($post['comment']);	
			

			  $error = false;

            if (!\Zend_Validate::is($name, 'NotEmpty')) {
                $error = true;
            }		
            
            if (!\Zend_Validate::is($email, 'EmailAddress')) {
                $error = true;
            }
            if (\Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                $error = true;
            }
            if ($error) {
                throw new \Exception();
            }	



            try
            {
				
			$model = $this->_objectManager->create('Digital\Productenquiry\Model\Productenquiry');
            $model->setData('productname', $productname);
            $model->setData('productsku', $productsku);
            $model->setData('name', $name);
            $model->setData('last_name', $last_name);
            $model->setData('telephone', $telephone);
            $model->setData('email', $email);
            $model->setData('expecteddate', $expecteddate);
            $model->setData('expected_people', $expected_people);                  
            $model->setData('occasion', $occasion);                  
            $model->setData('comment', $comment);
				
			$model->save();
            
            $helper = $this->_objectManager->get('Digital\Productenquiry\Helper\Data');

            $receiveremail = $helper->Recipientemail();
            $receiverInfo = [
                    'name' => 'Product Enquiry',
                    'email' => $receiveremail,
                ];

                $sendername = $helper->GeneralName();
                $senderemail = $helper->GeneralEmail();
                
                $senderInfo = [
                    'name' =>  $sendername,
                    'email' => $senderemail,
                ];

                
                
               

                $emailTemplateVariables = array();
                $emailTemplateVariables = array(
                    'productname'  =>  $productname,
                    'productsku'  =>  $productsku,
                    'name'          =>  $name,
                    'last_name'      =>  $last_name,
					'telephone'     =>  $telephone, 
                    'email'         =>  $email,                   
                    'expecteddate'     =>  $expecteddate,
                    'expected_people'     =>  $expected_people,     
                    'occasion'     =>  $occasion,     
                    'comment'       =>  $comment
                );          
                
                
                //$this->_objectManager->get('Digital\Productenquiry\Helper\Email')->enquiryMailSendMethod($emailTemplateVariables,$senderInfo,$receiverInfo);

                $customerInfo = [
                    'name' =>   $name,
                    'email' => $email,
                ];

                //$this->_objectManager->get('Digital\Productenquiry\Helper\Email')->enquiryMailSendMethodToCustomer($emailTemplateVariables,$senderInfo,$customerInfo);
				
				$this->messageManager->addSuccess(
                __('Thanks for product enquiry with us. We\'ll respond to you very soon.')
            );

        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
		
            }
            catch(\Exception $e)
            {
                $this->messageManager->addError(__('We can\'t process your request right now. Sorry, that\'s all we know.'));
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            }

            
        
        

    }
	
}
