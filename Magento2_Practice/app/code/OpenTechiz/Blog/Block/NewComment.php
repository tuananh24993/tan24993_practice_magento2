<?php
namespace OpenTechiz\Blog\Block;
use OpenTechiz\Blog\Api\Data\PostInterface;
use OpenTechiz\Blog\Model\ResourceModel\Post\Collection as PostCollection;
class NewComment extends \Magento\Framework\View\Element\Template
{
    protected $_request;
    protected $_customerSession;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\RequestInterface $request,
        array $data = []
    )
    {
        $this->_request = $request;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getFormAction()
    {
        $url = $this->getUrl('*/*', ['_direct' => 'post/comment/save', '_use_rewrite' => true]);
        return $url;
    }

    public function getAjaxUrl()
    {
        $url = $this->getUrl('*/*', ['_direct' => 'post/comment/load', '_use_rewrite' => true]);
        return $url;
    }

    public function getAjaxNotificationLoadUrl()
    {
        $url = $this->getUrl('*/*', ['_direct' => 'post/notification/load', '_use_rewrite' => true]);
        return $url;
    }

    public function getPostID()
    {
        return $this->_request->getParam('post_id', false);
    }

    public function  isLoggedIn()
    {
        return $this->_customerSession->isLoggedIn();
    }
}