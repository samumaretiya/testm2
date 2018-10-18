<?php

namespace Digital\Productenquiry\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface ProductenquiryLoaderInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Digital\Productenquiry\Model\Productenquiry
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}
