<?php

require_once 'app/Mage.php';

Mage::app();
$product = new Tutsplus_Demo_Model_Product;
$product->sayHello();

?>
