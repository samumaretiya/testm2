<?php

namespace Digital\Productenquiry\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class ProductenquiryLoader implements ProductenquiryLoaderInterface
{
    /**
     * @var \Digital\Productenquiry\Model\ProductenquiryFactory
     */
    protected $productenquiryFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \Digital\Productenquiry\Model\ProductenquiryFactory $productenquiryFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \Digital\Productenquiry\Model\ProductenquiryFactory $productenquiryFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->productenquiryFactory = $productenquiryFactory;
        $this->registry = $registry;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function load(RequestInterface $request, ResponseInterface $response)
    {
        $id = (int)$request->getParam('id');
        if (!$id) {
            $request->initForward();
            $request->setActionName('noroute');
            $request->setDispatched(false);
            return false;
        }

        $productenquiry = $this->productenquiryFactory->create()->load($id);
        $this->registry->register('current_productenquiry', $productenquiry);
        return true;
    }
}
