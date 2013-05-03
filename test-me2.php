
<?php 
require_once 'app/Mage.php';

ini_set('error_reporting', E_ALL);

Mage::init();



$make = $_GET["make"];

if ($make != "select") //if statement stopping null queries
{
/*if (!$make) //debugging purposes 
{
	$make = "Subaru";	
}

var_dump($make);*/

if ($make != "select")
{

$collection = Mage::getResourceModel('catalog/product_collection')
						 ->addAttributeToSelect(array('model'))
						 ->addFieldtoFilter('make',array(
						 	'eq'=>Mage::getResourceModel('catalog/product')
                        		->getAttribute('make')
                        		->getSource()
                        		->getOptionId($make)));
						 
 
//$collection->load(true);
//$collection->getSize();

foreach ($collection as $product) 
{
	$models[] = $product->getAttributeText('model');
}

$models = array_unique($models); 

sort($models);

array_filter($models);

echo "\n Model: <select class='att-select' id='second'>"; 
echo '\n\t <option value="select"> Please Select... </option>';
foreach ($models as $model)
{
	echo "\n\t  <option value='" . $model . "'>" . $model . "</option>";
		
}

echo "\n</select>";

}


}
?>
