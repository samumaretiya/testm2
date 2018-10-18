<?php
namespace Digital\Miscellaneous\Plugin\Checkout\Model;

use Magento\Catalog\Model\Product;

class Cart
{
   
    protected $checkoutSession;
	
	protected $uri;
    
	protected $responseFactory;
    
	protected $_urlinterface;
	
	private $messageManager;

	public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
		\Zend\Validator\Uri $uri,
        \Magento\Framework\UrlInterface $urlinterface,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\App\RequestInterface $request,
		\Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->checkoutSession = $checkoutSession;
		$this->uri = $uri;
        $this->_urlinterface = $urlinterface;
        $this->responseFactory = $responseFactory;
        $this->_request = $request;
		$this->messageManager = $messageManager;
    }

	public function beforeAddProduct(
            \Magento\Checkout\Model\Cart $subject,
            $productInfo,
            $requestInfo = null
        ) {
			if ($productInfo instanceof Product) {
				$productId = $productInfo->getId();
			} elseif (is_int($productInfo) || is_string($productInfo)) {
				$productId = $productInfo;
			} else {
				return $proceed($productInfo, $requestInfo);
			}
			$checkCart = 0;
			$quote = $this->checkoutSession->getQuote();
			$items = $quote->getAllItems();
			foreach ($items as $item) {

					$checkCart += 1;
					if( $checkCart > 1 || ($productId == $item->getProductId()))
					{
						$resultRedirect = $this->responseFactory->create();
						$resultRedirect->setRedirect($this->_urlinterface->getUrl('checkout'))->sendResponse('200');
						throw new \Magento\Framework\Exception\LocalizedException(__("You can't add more than one tour at once. you can either place separate order for individual order or delete previous once from the cart."));
					}
			}
			return array($productInfo, $requestInfo);
        }
}

?>