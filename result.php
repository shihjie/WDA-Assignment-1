<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="winestore.css"/>
<title> The Vinery </title>
</head>
<body>
<div class="background">
<div class="wrapper">
<div class="test">
<img src="imgs/logo.jpg" alt="Vinery logo"/>
</div>
<div class="container">
<h1 align="center"> Search Result</h1>
<br/>
<?php
$connection = mysqli_connect("localhost","root","helloworld","winestore");
ini_set('max_execution_time', 300);
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
				(SELECT COUNT(items.cust_id) FROM items WHERE items.wine_id=wine.wine_id) FROM wine
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
				(SELECT COUNT(items.cust_id) FROM items WHERE items.wine_id=wine.wine_id) FROM wine 
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


$test_result = mysqli_query ($connection, $query)
or die("Error: ".mysqli_error($connection));
$testcontent=false;
echo "<table align=center border=1 cellpadding=5px>";
echo "<tr><td>Wine Name</td> <td>Wine Varieties</td> <td>Year</td>";
echo "<td>Winery</td> <td>Region</td> <td>Minimum Price</td>";
echo "<td>Stocks</td> <td>Customers</td></tr>";
while ($row=mysqli_fetch_array($test_result))
{
$testcontent=true;
echo "<tr>";
echo "<td>".$row[0]."</td>";
echo "<td>".$row[1]."</td>";
echo "<td>".$row[2]."</td>";
echo "<td>".$row[3]."</td>";
echo "<td>".$row[4]."</td>";
echo "<td>".$row[5]."</td>";
echo "<td>".$row[6]."</td>";
echo "<td>".$row[7]."</td>";
echo "<tr>";
}
if($testcontent==false)
{
 echo "<tr><td colspan='8' align='center'>No Records match your search criteria</td></tr>";
}
echo "</table>";

mysqli_close($connection);
?>
</div>
</div>
</div>
</body>
</html>
