<?php
namespace PreferenceClass\Practice\Model\Catalog;
class Product extends \Magento\Catalog\Model\Product
{
    public function getName(){
        return $this->_getData(self::NAME) . ' + This is demo reference class';
    }
}