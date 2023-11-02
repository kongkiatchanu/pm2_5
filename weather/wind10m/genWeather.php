<?php
$url = 'https://www.cmuccdc.org/weather/wind10m/wind10m_0h.json';
//read json file from url in php
$readJSONFile = file_get_contents($url);
 
file_put_contents('/home/pm25v2/public_html/weather/wind10m/wind10m_0h.json', $readJSONFile);

