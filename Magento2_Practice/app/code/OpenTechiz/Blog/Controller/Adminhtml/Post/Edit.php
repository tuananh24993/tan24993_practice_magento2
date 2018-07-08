<?php
namespace OpenTechiz\Blog\Controller\Adminhtml\Post;
use Magento\Backend\App\Action;
class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('OpenTechiz_Blog::save');
    }
    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('OpenTechiz_Blog::post');
        return $resultPage;
    }
    public function execute()
    {
        // Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('OpenTechiz\Blog\Model\Post');
        // Initial checking
        if ($id) {
            $model->load($id);
            // If cannot get ID of model, display error message and redirect to List page
            if (!$model->getId()) {
                $this->messageManager->addError(__('This image no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        // Registry post
        $this->_coreRegistry->register('post', $model);
        // Build form
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getImage() : __('Create Image'));
        return $resultPage;
    }
}