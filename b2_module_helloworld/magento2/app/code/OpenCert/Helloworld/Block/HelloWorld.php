<?php
namespace OpenCert\Helloworld\Block;
 
class Helloworld extends \Magento\Framework\View\Element\Template
{
	protected $_registry;
	protected $_catalogSession;

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\Session $catalogSession,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_catalogSession = $catalogSession;
        parent::__construct($context, $data);
   	}

    public function getHelloWorldTxt()
    {
        return 'Hello world!'.$this->_registry->registry('I am Sudo.');
    }

    public function getCatalogSession() 
    {
        return $this->_catalogSession;
    }
}
