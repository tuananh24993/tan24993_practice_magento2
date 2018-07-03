<?php
namespace PracticeObservers\ObserverLog\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomerLogAction implements ObserverInterface{

    protected $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ){
        $this->_logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = $observer->getEvent()->getControllerAction()->getRequest();
        $action = $request->getFullActionName();
        $this->_logger->addInfo($action);
    }
}
