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
<h1 align="center"> Welcome to <font color="#006600">The Vinery!</font></h1>
<br/>
<?php
$connection = mysqli_connect("localhost","root","helloworld","winestore");
?>
<form id="winestore" enctype="multipart/form-data" onsubmit="return validateWSForm()" name="winestore" action="result.php" method="get">
<table align=center border=0 cellpadding=5px>
<tr>
<td>Wine Name</td>
<td><input type="text" size="30" maxlength="30" name="winename"></td>
</tr>
<tr>
<td>Region</td>
<td>
<?php
$result = mysqli_query ($connection,"SELECT region_name FROM region");
echo "<select name='region'>";
		while ($row = mysqli_fetch_row($result))
		{
			for ($i=0; $i<mysqli_num_fields($result); $i++)
			{
				echo "<option value='".$row[$i]."'>".$row[$i]."</option>";
			}
			echo "\n";
		}
echo "</select>";
?>
</td>
</tr>
<tr>
<td>Winery Name</td>
<td><input type="text" size="30" maxlength="30" name="wineryname"></td>
</tr>
<tr>
<td>Year Range</td>
<td>Starting</td>
<td>Ending</td>
</tr>
<tr>
</tr>
<td></td>
<td>
	<input type="date" name="startingyear">
</td>
<td>
	<input type="date" name="endingyear">
</td>
<tr>
<td>Minimum wines in stock</td>
<td><input type="text" size="7" maxlength="7" name="minstock"></td>
</tr>
<tr>
<td>Minimum customers</td>
<td><input type="text" size="7" maxlength="7" name="mincust"></td>
</tr>
<tr>
<td>Cost Range</td>
<td>Minimum Cost</td>
<td>Maximum Cost</td>
</tr>
<tr>
<td></td>
<td>
	<input type="text" size="7" maxlength="7" name="mincost">
</td>
<td>
	<input type="text" size="7" maxlength="7" name="maxcost">
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Search"></td>
</tr>
</table>
<br/>
</form>
</div>
</div>
</div>
<?php
mysqli_close($connection);
?>
<script type="text/javascript" src="validateWSForm.js"></script>
</body>
</html>
