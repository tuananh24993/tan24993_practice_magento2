<?php
namespace OpenTechiz\Blog\Helper;
use Magento\Framework\App\Action\Action;
class UserInfo extends \Magento\Framework\App\Helper\AbstractHelper
{

    protected $_customerSession;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Http\Context $httpContext
    )
    {
        parent::__construct($context);
        $this->httpContext = $httpContext;
    }

    public function isLoggedIn()
    {
        $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return $isLoggedIn;
    }
}