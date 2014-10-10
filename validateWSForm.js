function validateWSForm()
{

var numeric = /^$|^[0-9]+$/;
var alphanumeric = /^$|^[A-Za-z0-9]+$/;


if (document.getElementById("winestore").winename.value.match(alphanumeric))
{
	if (document.getElementById("winestore").wineryname.value.match(alphanumeric))
	{
		if ((document.getElementById("winestore").startingyear)<=(document.getElementById("winestore").endingyear))
		{
			if (document.getElementById("winestore").minstock.value.match(numeric))
			{
				if (document.getElementById("winestore").mincust.value.match(numeric))
				{
					if (document.getElementById("winestore").mincost.value.match(numeric))
					{
						if (document.getElementById("winestore").maxcost.value.match(numeric))
						{
							if ((document.getElementById("winestore").mincost)<=(document.getElementById("winestore").maxcost))
							{
								return true;
							}
							else
							{
								window.alert("Minimum cost cannot be larger than maximum cost.");
								return false;
							}
						}
						else
						{
							window.alert("Maximum cost must numeric value.");
							return false;
						}
					}
					else
					{
						window.alert("Minimum cost must numeric value.");
						return false;
					}
				}
				else
				{
					window.alert("Minimum customers must numeric value.");
					return false;
				}
			}
			else
			{
				window.alert("Minimum wines in stock must numeric value.");
				return false;
			}
		}
		else
		{
			window.alert("Starting year cannot be larger than ending year.");
			return false;
		}
	}
	else
	{
	  window.alert("Winery name must be alphanumeric value.");
	  return false;
	}
}
else
{
  window.alert("Wine name must be alphanumeric value.");
  return false;
}
}
