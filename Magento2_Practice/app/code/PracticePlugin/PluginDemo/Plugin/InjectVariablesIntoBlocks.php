<?php
namespace PracticePlugin\PluginDemo\Plugin;
use Magento\Theme\Block\Html\Footer;
class InjectVariablesIntoBlocks
{
    protected $customerSession;
    public function __construct(
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->customerSession = $customerSession;
    }
    public function beforeToHtml(Footer $subject)
    {
        if ($subject->getNameInLayout() !== 'absolute_footer') {
            return;
        }
        $subject->setTemplate('PracticePlugin_PluginDemo::absolute_footer.phtml');
        $subject->assign('customer', $this->customerSession->getCustomer());
    }
}