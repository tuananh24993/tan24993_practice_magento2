<?php
 
namespace OpenCert\Helloworld\Controller\Index;
 
use Magento\Framework\App\Action\Context;
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_registry;
 
    public function __construct(
        Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry

        )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_registry = $registry;
        parent::__construct($context);
    }
 
    public function execute()
    {
        $this->_registry->registry('I am Sudo.','Haha');
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}

