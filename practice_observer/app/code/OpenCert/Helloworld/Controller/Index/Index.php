<?php
 
namespace OpenCert\Helloworld\Controller\Index;
 
use Magento\Framework\App\Action\Context;
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_registry;
    protected $_logger;
 
    public function __construct(
        Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Psr\Log\LoggerInterface $logger

        )
    {
        $this->_logger = $logger;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_registry = $registry;
        parent::__construct($context);
    }
 
    public function execute()
    {
        /*$this->_registry->registry('sudo','Haha');
        $resultPage = $this->_resultPageFactory->create();
        echo "<pre>";
        var_dump($resultPage);
        echo "</pre>";
        die();
        return $resultPage;*/
        /*Debug_backtrace*/
        $debugBackTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        foreach ($debugBackTrace as $item) {
            echo @$item['class'] . @$item['type'] . @$item['function'] . "\n";
            echo '<pre>';
            print_r($item);
        }
    }
}

