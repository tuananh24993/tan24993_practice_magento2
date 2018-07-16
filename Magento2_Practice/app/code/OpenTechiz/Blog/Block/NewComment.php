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
        return '/magen/post/comment/save';
    }

    public function getAjaxUrl()
    {
        return '/magen/post/comment/load';
    }

    public function getAjaxNotificationLoadUrl()
    {
        return '/magen/post/notification/load';
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