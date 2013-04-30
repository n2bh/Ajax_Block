<?php 
require_once 'app/Mage.php';

ini_set('error_reporting', E_ALL);

Mage::init();


$model = $_GET["model"];

/*if (!$model) //debugging purposes 
{
	$model = "Volare";	
}

var_dump($model);*/

$collection = Mage::getResourceModel('catalog/product_collection')
						 ->addAttributeToSelect('*')
						 ->addFieldtoFilter('model',array(
						 	'eq'=>Mage::getResourceModel('catalog/product')
                        		->getAttribute('model')
                        		->getSource()
                        		->getOptionId($model)));
						 
//$collection->load(true); 

//var_dump(count($collection));

foreach ($collection as $product) 
{
	$_product = Mage::getModel('catalog/product')->load($product->getId());
	//var_dump($_product);
	$years[] = $_product->getAttributeText('year');

}

$years = array_unique($years); 

sort($years);

echo "Year: <select class='att-select' id='third'>"; 

foreach ($years as $year)
{
	echo "  <option value='" . $year . "'>" . $year . "</option>";
		
}

echo "</select>";





?> 