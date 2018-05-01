<?php

$str = "{&quot;invoice_to_text&quot;:&quot;Kuch Bhi&quot;,&quot;gst_num&quot;:&quot;&quot;,&quot;cid&quot;:&quot;1&quot;,&quot;sid&quot;:&quot;7&quot;,&quot;service&quot;:[&quot;ser1&quot;],&quot;description&quot;:[&quot;des1&quot;],&quot;tenure&quot;:[&quot;ten1&quot;],&quot;rate&quot;:[&quot;rate1&quot;],&quot;amount&quot;:[&quot;amt1&quot;],&quot;quote_create&quot;:&quot;Submit Quote&quot;}";

// echo htmlspecialchars_decode($str);
echo $json=htmlspecialchars_decode($str, ENT_NOQUOTES);
// $obj = json_decode($json);
//print $obj->{'sales_id'}; 

$obj = json_decode($json);
print $obj->{'sid'}; // 12345

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