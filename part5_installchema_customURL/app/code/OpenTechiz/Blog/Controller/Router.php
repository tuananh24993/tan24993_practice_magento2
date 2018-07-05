<?php
namespace OpenTechiz\Blog\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    protected $actionFactory;
    protected $_eventManager;
    protected $_postFactory;
    protected $_appState;
    protected $_url;
    protected $_response;

    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\UrlInterface $url,
        \OpenTechiz\Blog\Model\PostFactory $postFactory,
        \Magento\Framework\App\ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->_eventManager = $eventManager;
        $this->_url = $url;
        $this->_pageFactory = $postFactory;
        $this->_response = $response;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $url_key = trim($request->getPathInfo(), '/blog/');
        $url_key = rtrim($url_key, '/');

        $post = $this->_pageFactory->create();
        $post_id = $post->checkUrlKey($url_key);
        if (!$post_id) {
            return null;
        }
        $request->setModuleName('post')->setControllerName('view')->setActionName('index')->setParam('post_id', $post_id);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $url_key);
        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
    }
}