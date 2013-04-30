
<?php 
require_once 'app/Mage.php';

ini_set('error_reporting', E_ALL);

Mage::init();


$make = $_GET["make"];

/*if (!$make) //debugging purposes 
{
	$make = "Subaru";	
}

var_dump($make);*/


$collection = Mage::getResourceModel('catalog/product_collection')
						 ->addAttributeToSelect('*')
						 ->addFieldtoFilter('make',array(
						 	'eq'=>Mage::getResourceModel('catalog/product')
                        		->getAttribute('make')
                        		->getSource()
                        		->getOptionId($make)));
						 
 
//$collection->load(true);
//$collection->getSize();

foreach ($collection as $product) 
{
	$_product = Mage::getModel('catalog/product')->load($product->getId());
	//var_dump($_product);
	$models[] = $_product->getAttributeText('model');

}

$models = array_unique($models); 

sort($models);

array_filter($models);

echo "Model: <select class='att-select' id='second'>"; 

foreach ($models as $model)
{
	echo "  <option value='" . $model . "'>" . $model . "</option>";
		
}

echo "</select>";



?>
