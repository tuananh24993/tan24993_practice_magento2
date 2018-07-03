<?php
namespace TuanAnh\ProductRepositoryInterface\Block;

class MyBlock extends \Magento\Framework\View\Element\Template
{
    protected $_productRepository;
    protected $_productFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        /*\Magento\Catalog\Model\ProductRepository $productRepository,*/
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        /*\Magento\Catalog\Model\ProductFactory $productFactory,*/
        array $data = []
    ) {
        $this->_productRepository = $productRepository;
        /*$this->_productFactory = $productFactory;*/
        parent::__construct($context, $data);
    }

    public function getProductById($id) {
        return $this->_productRepository->getById($id);
    }

    public function getProductBySku($sku) {
        return $this->_productRepository->get($sku);
    }
}