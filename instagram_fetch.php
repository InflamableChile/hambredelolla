<html>
<body>
<?php 

function callInstagram($url)
{
	echo "Before Init";
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2
	));
	echo "After init - Before Close";
	$result = curl_exec($ch);
	curl_close($ch);
	echo "After Close";
	return $result;
}

$tag = 'hambredelolla';
$client_id = "75f2413d0c3746eeafb334cb6da61534";

$url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;
echo "URL DE MIERDA";
echo $url;

$inst_stream = callInstagram($url);
echo "LA WEA QLIA ANTERIOR\n";
echo $inst_stream;
$results = json_decode($inst_stream, true);

echo "LA WEA QLIA\n";
echo $results['data'];

//Now parse through the $results array to display your results... 
/*foreach($results['data'] as $item){
	echo $image_link;
    $image_link = $item['images']['high_resolution']['url'];
    echo '<img src="'.$image_link.'" />';
}*/

?>
</body>
</html>