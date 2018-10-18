<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Digital\Faqs\Controller;
/**
 * Cms Controller Router
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
use Magento\Framework\DataObject;
class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;
    /**
     * Event manager
     *
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $_eventManager;
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * Page factory
     *
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $_galleryFactory;
    /**
     * Config primary
     *
     * @var \Magento\Framework\App\State
     */
    protected $_appState;
    /**
     * Url
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;
    /**
     * Response
     *
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $_response;
    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\ResponseInterface $response
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\UrlInterface $url, 
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->_eventManager = $eventManager;
        $this->_url = $url; 
        $this->_storeManager = $storeManager;
        $this->_response = $response;
    }
    /**
     * Validate and Match Cms Page and modify request
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
		 $url_key = '';
		 $url_key = trim($request->getPathInfo(), '/');
		 $origUrlKey = $url_key;
			if ($request->getModuleName() === 'faqs') {
				return;
			}
       
       
        
        $origUrlKey = $url_key;
        $condition = new DataObject(['url_key' => $url_key, 'continue' => true]); 
		if(strpos($url_key,'ezicreditfaq') === false){
			return;
		}
        $this->_eventManager->dispatch(
            'faqs_controller_router_match_before',
            ['router' => $this, 'condition' => $condition]
        );
        $url_key = $condition->getUrlKey();
        if ($condition->getRedirectUrl()) {
            $this->_response->setRedirect($condition->getRedirectUrl());
            $request->setDispatched(true);
            return $this->actionFactory->create(
                'Magento\Framework\App\Action\Redirect',
                ['request' => $request]
            );
        }

        if (!$condition->getContinue()) {
            return null;
        }
        /** @var \Magento\Cms\Model\Page $page */
         
        $request->setModuleName('faqs')->setControllerName('index')->setActionName('index')->setParam('ezicredit',1);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
        return $this->actionFactory->create(
            'Magento\Framework\App\Action\Forward',
            ['request' => $request]
        );
    }
}
