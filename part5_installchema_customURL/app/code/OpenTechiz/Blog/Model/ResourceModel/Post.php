<?php
namespace OpenTechiz\Blog\Model\ResourceModel;
class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_date;
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    protected function _construct()
    {
        $this->_init('opentechiz_blog_post', 'post_id');
    }
}