<?php
include('function/function.php');
// $str = '{&quot;invoice_to_text&quot;:&quot;Kuch Bhi&quot;,&quot;gst_num&quot;:&quot;GST 754675&quot;,&quot;cid&quot;:&quot;1&quot;,&quot;sid&quot;:&quot;7&quot;,&quot;service&quot;:[&quot;ser1&quot;,&quot;ser1&quot;],&quot;description&quot;:[&quot;des1&quot;,&quot;des1&quot;],&quot;tenure&quot;:[&quot;ten1&quot;,&quot;ten1&quot;],&quot;rate&quot;:[&quot;rate1&quot;,&quot;rate1&quot;],&quot;amount&quot;:[&quot;amt1&quot;,&quot;amt1&quot;],&quot;quote_create&quot;:&quot;Submit Quote&quot;}';

// // // echo htmlspecialchars_decode($str);
// $json=htmlspecialchars_decode($str);
// $obj=json_decode($json,true);

// $count = 0;
// foreach ($obj['description'] as $type) {
//     $count+= count($type);
// }
// echo $count;
// $obj=json_decode($json,true);
// var_dump($obj);
$insert = $query->execute();
		if($insert){
			$data['id'] = $pdo->lastInsertId();
			return $data;
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>

</p>
</body>
</html>