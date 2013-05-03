<?php 
require_once 'app/Mage.php';

ini_set('error_reporting', E_ALL);

Mage::init();


$model = $_GET["model"];

$make = $_GET["make"];


if ($model != "select") 
{
/*if (!$model) //debugging purposes 
{
	$model = "Volare";	
}

var_dump($model);*/

$collection = Mage::getResourceModel('catalog/product_collection')
						 ->addAttributeToSelect(array('make','model','year'))
						 ->addFieldtoFilter('model',array(
						 	'eq'=>Mage::getResourceModel('catalog/product')
                        		->getAttribute('model')
                        		->getSource()
                        		->getOptionId($model)))
						  ->addFieldtoFilter('make',array(
						 	'eq'=>Mage::getResourceModel('catalog/product')
                        		->getAttribute('make')
                        		->getSource()
                        		->getOptionId($make)));
						 
//$collection->load(true); 

//var_dump(count($collection));

foreach ($collection as $product) 
{
	
	$years[] = $product->getAttributeText('year');

}

$years = array_unique($years); 

sort($years);

echo "\nYear: <select class='att-select' id='third'>"; 
echo '<option value="select"> Please Select...</option>';
foreach ($years as $year)
{
	echo "\n\t  <option value='" . $year . "'>" . $year . "</option>";
		
}

echo "\n</select>";


}


?> 