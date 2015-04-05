<?php

/** @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
 
$installer->addAttribute(
    Mage_Catalog_Model_Product::ENTITY,
    'affiliate_link',
    array(
        'type'                    => 'text',
        'backend'                 => '',
        'frontend'                => '',
        'label'                   => 'Affiliate Link',
        'input'                   => 'text',
        'class'                   => '',
        'source'                  => '',
        'global'                  => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'                 => true,
        'required'                => true,
        'user_defined'            => false,
        'default'                 => '',
        'searchable'              => false,
        'filterable'              => false,
        'comparable'              => false,
        'visible_on_front'        => false,
        'unique'                  => false,
        'apply_to'                => 'affiliate',
        'is_configurable'         => false,
        'used_in_product_listing' => false
    )
);


$attributeId = $installer->getAttributeId(
    'catalog_product',
    'affiliate_link'
);
 
    $defaultSetId = $installer->getAttributeSetId('catalog_product', 'default');
 
$installer->addAttributeGroup(
    'catalog_product',
    $defaultSetId,
    'Affiliate Information'
);
 
//find out the id of the new group
$groupId = $installer->getAttributeGroup(
    'catalog_product',
    $defaultSetId,
    'Affiliate Information',
    'attribute_group_id'
);
 
//assign the attribute to the group and set
if ($attributeId > 0) {
    $installer->addAttributeToSet(
        'catalog_product',
        $defaultSetId,
        $groupId,
        $attributeId
    );
}
 
$installer->endSetup();

?>
