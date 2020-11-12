<?php

class VS7_LimitProductList_Model_Observer
{
    public function checkLimitReached($event)
    {
        $_productCollection = $event->getCollection();
        if ($_productCollection->getCurPage() > 1) {
            if (
                ($_productCollection->getLastPageNumber() == $_productCollection->getCurPage(-1))
                && ($_productCollection->getCurPage() == $_productCollection->getCurPage(-1))
            ) {
                Mage::unregister('_singleton/core/layout');
                $exception = new Mage_Core_Controller_Varien_Exception('404');
                $exception->prepareForward('norouteAction');
                throw $exception;
            }
        }
    }
}