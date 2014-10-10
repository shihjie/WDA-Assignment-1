<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
set_include_path('C:\wamp\bin\php\pear');
require_once "HTML/Template/IT.php";
require_once "DB.php";
// require "../db.inc";

$password="helloworld";
$username="root";
$hostname="localhost";
$dbname="winestore";

$dsn = "mysql://{$username}:{$password}@{$hostname}/{$dbname}";
	$DB = new DB();
	$connection=$DB->connect($dsn);
ini_set('max_execution_time', 300);
$template = new HTML_Template_IT(".");    
$template->loadTemplatefile("Template_DB.tpl", true, true);

$templateFail = new HTML_Template_IT(".");    
$templateFail->loadTemplatefile("TemplateFail_DB.tpl", false, false);	

$winename=$_GET['winename'];
$region=$_GET['region'];
$wineryname=$_GET['wineryname'];
$startingyear=$_GET['startingyear'];
$endingyear=$_GET['endingyear'];
$minstock=$_GET['minstock'];
$mincust=$_GET['mincust'];
$mincost=$_GET['mincost'];
$maxcost=$_GET['maxcost'];
if(($startingyear==null)||($startingyear==""))
{
	$startingyear=0;
}
if(($endingyear==null)||($endingyear==""))
{
	$endingyear=9999;
}
if(($mincost==null)||($mincost==""))
{
	$mincost=0;
}
if(($maxcost==null)||($maxcost==""))
{
	$maxcost=9999999;
}
if(($minstock==null)||($minstock==""))
{
	$minstock=0;
}
if(($mincust==null)||($mincust==""))
{
	$mincust=0;
}
$query;
if($region=="All")
{
	$query = "SELECT DISTINCT wine.wine_name, grape_variety.variety, wine.year, winery.winery_name, region.region_name, inventory.cost, inventory.on_hand,
				(SELECT COUNT(items.cust_id) FROM items WHERE items.wine_id=wine.wine_id) AS test
				FROM wine 
				INNER JOIN winery ON wine.winery_id=winery.winery_id 
				INNER JOIN region ON winery.region_id=region.region_id
				INNER JOIN inventory ON inventory.wine_id=wine.wine_id 
				INNER JOIN items ON wine.wine_id=items.wine_id 
				INNER JOIN wine_variety ON wine.wine_id=wine_variety.wine_id 	
				INNER JOIN grape_variety ON wine_variety.variety_id=grape_variety.variety_id 	
				WHERE wine.wine_name like '%".$winename."%' 
				AND winery.winery_name like '%".$wineryname."%'
				AND (wine.year>='".$startingyear."' 
				OR wine.year<='".$endingyear."') 
				AND inventory.on_hand>='".$minstock."'
				AND (SELECT COUNT(items.cust_id) FROM items WHERE items.wine_id=wine.wine_id)>='".$mincust."'
				AND (inventory.cost>='".$mincost."' 
				OR inventory.cost<='".$maxcost."')";
}
else
{


	$query = "SELECT DISTINCT wine.wine_name, grape_variety.variety, wine.year, winery.winery_name, region.region_name, inventory.cost, inventory.on_hand,
				(SELECT COUNT(items.cust_id) FROM items WHERE items.wine_id=wine.wine_id) AS test
				FROM wine 
				INNER JOIN winery ON wine.winery_id=winery.winery_id 
				INNER JOIN region ON winery.region_id=region.region_id
				INNER JOIN inventory ON inventory.wine_id=wine.wine_id 
				INNER JOIN items ON wine.wine_id=items.wine_id 	
				INNER JOIN wine_variety ON wine.wine_id=wine_variety.wine_id 	
				INNER JOIN grape_variety ON wine_variety.variety_id=grape_variety.variety_id 	
				WHERE wine.wine_name like '%".$winename."%' 
				AND winery.winery_name like '%".$wineryname."%'
				AND region.region_name='".$region."'
				AND (wine.year>='".$startingyear."' 
				OR wine.year<='".$endingyear."') 
				AND inventory.on_hand>='".$minstock."'
				AND (SELECT COUNT(items.cust_id) FROM items WHERE items.wine_id=wine.wine_id)>='".$mincust."'
				AND (inventory.cost>='".$mincost."' 
				OR inventory.cost<='".$maxcost."')";
}

$test=$connection->query($query);

// $test_result = mysqli_query ($connection, $query)
// or die("Error: ".mysqli_error($connection));

if($test->numrows() == 0)
{
$templateFail->setCurrentBlock("SEARCH_FAIL");
	
$templateFail->show();
}

else
{
while ($row = $test->fetchRow(DB_FETCHMODE_ASSOC))
		{		
		
			$template->setCurrentBlock("SEARCH_RESULTS");	
			
			$template->setVariable("WINENAME", $row["wine_name"]);
			$template->setVariable("WINE_VARIETY", $row["variety"]);
			$template->setVariable("YEAR", $row["year"]);
			$template->setVariable("WINERY_NAME", $row["winery_name"]);
			$template->setVariable("REGION_NAME", $row["region_name"]);
			$template->setVariable("ON_HAND", $row["on_hand"]);
			$template->setVariable("MIN_COST", $row["cost"]);
			$template->setVariable("MIN_CUSTOMERS", $row["test"]);
			 
			$template->parseCurrentBlock(); 
				
		} 
		$template->show();
}

	
	
?>
</div>
</div>
</div>
</body>
</html>
