<!DOCTYPE html>
<head>

</head>
	
	<?
	$day=date("G");

	$country = geoip_country_code_by_name('locahost:8888');
	if ($country) {
	    echo 'This host is located in: ' . $country;
	}

	?>
	
<body>

	Today is <?=$day?>.
	

</body>
</html>