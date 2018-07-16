<?php
namespace OpenTechiz\Blog\Observer;
use Magento\Framework\Event\ObserverInterface;
class Approval implements ObserverInterface
{
    protected $_postFactory;
    protected $_customerSession;
    protected $_checkoutSession;
    protected $_notiFactory;
    protected $_notiCollectionFactory;

    public function __construct(
        \OpenTechiz\Blog\Model\PostFactory $postFactory,
        \OpenTechiz\Blog\Model\NotificationFactory $notiFactory,
        \OpenTechiz\Blog\Model\ResourceModel\Notification\CollectionFactory $notiCollectionFactory
    )
    {
        $this->_postFactory = $postFactory;
        $this->_notiFactory = $notiFactory;
        $this->_notiCollectionFactory = $notiCollectionFactory;
    }
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $comment = $observer->getData('comment');
        $request = $observer->getData('request');
        $originalComment = $comment->getOrigData();
        // new comment then return
        if(!$request->getParam('comment_id')) return;
        $newStatus = $comment->isActive();
        $oldStatus = $originalComment['is_active'];
        $user_id = $originalComment['user_id'];
        $post_id = $originalComment['post_id'];
        $comment_id = $originalComment['comment_id'];
        // check if this comment approved before
        $notiCheck = $this->_notiCollectionFactory->create()
            ->addFieldToFilter('comment_id', $comment_id);
        if($notiCheck->count()>0) return;
        // if user_id null then return
        if(!$user_id) return;
        if($oldStatus != 0) return;
        if($newStatus == null) return;
        if($newStatus == 2) return;
        if($oldStatus == $newStatus) return;
        // get post info
        $post = $this->_postFactory->create()->load($post_id);
        $postTitle = $post->getTitle();
        $noti = $this->_notiFactory->create();
        $content = "Your comment ID: $comment_id at Post: $postTitle has been approved by Admin";
        $noti->setContent($content);
        $noti->setUserID($user_id);
        $noti->setCommentID($comment_id);
        $noti->setPostID($post_id);
        $noti->save();

    }
}