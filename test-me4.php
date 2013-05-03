<?php 
require_once 'app/Mage.php';

ini_set('error_reporting', E_ALL);

Mage::init();

$model = $_GET["model"];

$make = $_GET["make"];

$year = $_GET["year"];

if ($year != "select") 
{
	
$collection = Mage::getResourceModel('catalog/product_collection')
						 ->addAttributeToSelect('*')
						 ->addFieldtoFilter('model',array(
						 	'eq'=>Mage::getResourceModel('catalog/product')
                        		->getAttribute('model')
                        		->getSource()
                        		->getOptionId($model)))
						  ->addFieldtoFilter('make',array(
						 	'eq'=>Mage::getResourceModel('catalog/product')
                        		->getAttribute('make')
                        		->getSource()
                        		->getOptionId($make)))
							->addFieldtoFilter('year',array(
						 	'eq'=>Mage::getResourceModel('catalog/product')
                        		->getAttribute('year')
                        		->getSource()
                        		->getOptionId($year)));
								
//$collection->load(true);

if (count($collection) == 1)
{
	foreach ($collection as $product) 
	{
		echo $product->getProductUrl();
	}
}
else 
{
	//get the ids of all three attributes 
	$make = Mage::getSingleton('eav/config')->getAttribute('catalog_product', 'make')->getSource()->getOptionId($make);
	$model = Mage::getSingleton('eav/config')->getAttribute('catalog_product', 'model')->getSource()->getOptionId($model);
	$year = Mage::getSingleton('eav/config')->getAttribute('catalog_product', 'year')->getSource()->getOptionId($year);
	echo "http://richard.turtlehut.net/catalytic-converter" . '?make=' . $make . '&model=' . $model . '&year=' . $year;
}
	
	
}


?> 
