<!DOCTYPE HTML PUBLIC
                 "-//W3C//DTD HTML 4.01 Transitional//EN"
                 "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Wine Search</title>
<body>
	  	<table style="margin-left:130px;margin-top:10px" border='1' >		
		<tr>
			<th>Wine Name</th>
			<th>Wine Variety</th>
			<th>Year</th>
			<th>Winery Name</th>
			<th>Region Name</th>
			<th>Bottles in Stock</th>
			<th>Minimum Cost</th>
			<th>No of People Who Purchased the Wine</th>
		</tr>
		<!-- BEGIN SEARCH_RESULTS -->		
		<tr>
			
			<td style='text-align:center'>{WINENAME}</td>
			<td style='text-align:center'>{WINE_VARIETY}</td>
			<td style='text-align:center'>{YEAR}</td>
			<td style='text-align:center'>{WINERY_NAME}</td>
			<td style='text-align:center'>{REGION_NAME}</td>
			<td style='text-align:center'>{ON_HAND}</td>
			<td style='text-align:center'>{MIN_COST}</td>
			<td style='text-align:center'>{MIN_CUSTOMERS}</td>	
			
		</tr>
		<!-- END SEARCH_RESULTS -->		
		
	</table>
</body>
</html>
