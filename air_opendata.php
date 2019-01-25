<?php
header("Access-Control-Allow-Origin:*");
$url="http://opendata.epa.gov.tw/webapi/Data/REWIQA/?$orderby=SiteName&$skip=0&$top=1000&format=json";
echo $content;
//echo json_encode($content);
?>