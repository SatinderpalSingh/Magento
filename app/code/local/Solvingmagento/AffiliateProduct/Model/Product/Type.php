<?php

class Solvingmagento_AffiliateProduct_Model_Product_Type
        extends Mage_Catalog_Model_Product_Type_Virtual
{
    const TYPE_AFFILIATE          = 'affiliate';
    const XML_PATH_AUTHENTICATION = 'catalog/affiliate/authentication';
 
    protected function _prepareProduct(Varien_Object $buyRequest, $product, $processMode)
    {
        if ($this->_isStrictProcessMode($processMode)) {
            return Mage::helper('solvingmagento_affiliateproduct')->__(
                'Affiliate product %s cannot be added to cart. ' .
                ' On the product detail page click the "Go to parent site"'.
                ' button to access the product.',
                $product->getName()
            );
        }
        return parent::_prepareProduct($buyRequest, $product, $processMode);
    }
}
