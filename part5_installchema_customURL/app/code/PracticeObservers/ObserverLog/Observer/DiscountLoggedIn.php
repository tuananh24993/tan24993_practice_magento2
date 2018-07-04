<?php

namespace PracticeObservers\ObserverLog\Observer;

use Magento\Framework\Event\ObserverInterface;

class DiscountLoggedIn implements ObserverInterface
{

    public function execute (\Magento\Framework\Event\Observer $observer)
    {
        // TODO: Implement execute() method.
        $item = $observer->getEvent()->getData('quote_item');
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);
        $price = $item->getProduct()->getPriceInfo()->getPrice('final_price')->getValue();
        $new_price = $price - ($price * 50 / 100);
        $item->setCustomPrice($new_price);
        $item->setOriginalCustomPrice($new_price);
        $item->getProduct()->setIsSuperMode(true);

    }
}