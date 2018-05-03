<?php
$cid=$_POST['cid']; 
$quote=sqlfetch("SELECT * FROM `quote` WHERE cid='$cid'");
foreach ($quote as $quote_details) {
	$quote_data=$quote_details;
}
$str_json=$quote_data['quote'];
$json=htmlspecialchars_decode($str_json);
$obj=json_decode($json,true);

$no_of_item=$obj['no_of_item'];
 ?>

<html>
	<head>
		<style>
			.invoice_det_bottom table{float:right; width:250px; margin-top:20px; margin-left:100px; font-size:11px;}
			
			.particulars table{ border: 1px solid #d8d8d7; font-family:sans-serif; font-size:11px; text-align:center; height:130px; border-collapse:collapse; width:100%;}
			.particulars table tr th{border: 1px solid #d8d8d7; font-weight:550; padding:7px;}
			.particulars table tr td{border:1px solid #d8d8d7; padding:10px;  font-size:10px;}
			body { font-family: calibri; padding:2px; font-size:14px; }
			.section { width: 100%; float:left; display:block;  }
			.main_container{ width:2480px; height: 3508px; margin:0 auto; padding:30px; box-shadow:0px 0px 5px  #CCC; }
			.container { width:2480px; text-align:left; margin:0 auto; } 
			.head_left { width:50%; float:left; text-align:left; } 
			.logo_img  { width:400px; margin:200px; margin-left:20px; }
			.header  { border-bottom:1px solid #CCC; margin-bottom:15px; }
			.header span { color:skyblue; position:absolute; top:0px; font-weight:700; padding:4px; background:white; font-size:15px; }
			.head_right { width:50%; float:left; text-align:right; padding-top:10px; } 
			.head_right h3 { margin: 0; letter-spacing: 0px; font-size: 20px; }
			.head_right p { font-size:9px; }
			.invoice_det_left { float:left; width:50%; font-size:10px; }
			.invoice_det_right { float:right; width:50%; font-size:10px; text-align:right; }
			.invoice_det_right table { float:right; font-size:10px; }
			.invoice_det_right table th { text-align:left; padding-right:20px; height:14px; line-height:1.2;}
			.invoice_det_right table tr { line-height:30px; height:30px;}
			
			.footer_note { text-align:center; } 
		</style>
	</head>
	<body>
			<?php 
			$cid=$_POST['cid'];
			$invoice_customer_detail=sqlfetch("Select * FROM `customer` where id='$cid'"); 
			if(count($invoice_customer_detail))
				foreach($invoice_customer_detail as $invoice_customer)
				{
					$default_customer=$invoice_customer;
				}
			?>
			<?php 
			$sales_details=sqlfetch("SELECT * FROM `sale_done` WHERE cid='$cid'");
			if (count($sales_details)) {
			foreach ($sales_details as $sales) {
				$default_sales=$sales;
			}
			}
			 ?>
		<div class="main_container">
		<div class="section header">
			<div class="container">
				<div class="head_left">
					<img class="logo_img" src="images/logo.png" width="230px" class="logo" />
				</div>
				<div class="head_right">
					<h3>B2BEnquiry.com</h3>
					<p style="font-size:9px;">11-A,Gulab Bagh, Opposite Metro Pillar No. 736, <br> 
						Near by Nawada Metro Station,<br>
						Uttam Nagar, New Delhi<br>
						Delhi - 110059<br>
						India<br>
						</p>
				</div>
			</div>
			<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TAX INVOICE</span>
		</div>
		<div class="section invoice_det">
			<div class="container">
				<div class="row">
					<div class="invoice_det_left">
					<span>Bill To</span>
					<p style="font-size:10px; font-family:sans-serif;">
						<strong style="font-size:12;"><?php echo $obj['invoice_to_text']; ?></strong><br>
						<?=$default_customer['addr'];?><br>
						<?=$default_customer['city'];?><br>
						<?=$default_customer['state'];?>-<?=$default_customer['zip'];?><br>
						<?=$default_customer['country'];?><br>
						<?php echo $obj['gst_num']; ?>
						<br>
						<br>
						Place of Supply: Delhi
					</p>
					</div>
					<div class="invoice_det_right">
						<table align="right" style="font-size:10px;">
							<tr><th>Tax Invoice#</th><td><?php echo $iv; ?></td></tr>
							<tr><th>Date</th><td><?php echo date("d-m-Y"); ?></td></tr>
							<tr><th>Payment Terms</th><td>Paid</td></tr>
							<tr><th>Payment Due Date</th><td>NA</td></tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="particulars" >
						<table>
							<tr style="background-color:#f4f6f7; text-align:center;">
								<th>#</th>
								<th width="140">Service</td>
								<th width="180">Description</th>
								<th>Tenure</th>
								<th align="right" width="70">Rate</th>
								<th align="right" width="100">Amount</th>
							</tr>
							<?php for($i=0;$i<$no_of_item;$i++){ ?>
							<tr>
								<td><?php echo $i+1;; ?></td>
								<td><?php echo $obj['service'][$i]; ?></td><br>
								<td><?php echo $obj['description'][$i]; ?></td><br>
								<td><?php echo $obj['tenure'][$i]; ?></td>
								<td align="right" width="70"><?php echo $obj['rate'][$i]; ?></td>
								<td align="right" width="100"><?php echo $obj['amount'][$i]; ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="section invoice_det">
			<div class="container">
				<div class="row">
					<div class="invoice_det_left">
					<br>
										
						<p style="font-size:12px; font-family:Times New Roman, Serif;"><b>B2BEnquiry.com is an IT Company, Providing all Web related 
						Services across the globe. SEO and E-Commerce Websites are our 
						speciality.</b></p>						
						
						<p style="font-size:14px; font-weight:600px; font-family:Times New Roman, Serif;">IMPORTANT CONTACTS -</p>
						<p style="font-size:12px; font-weight:600px;">
						<span>Sales:-&nbsp;</span><br>
						<span>Email:-&nbsp;Sales@b2benquiry.com</span><br>                       
						<span>Contact:-&nbsp;+91 7210018919</span><br> 
						<span>Support:-&nbsp; </span><br>                  
						<span>Contact:-&nbsp;+91 1165178885</span><br>
						<span>Billing:-&nbsp;</span>  <br>   
						<span>Email:-&nbsp;billing@b2benquiry.com</span><br>						
						<span>Contact-&nbsp;+91 1165957353</span>										
					</p>
					</div>
					<div class="invoice_det_bottom">
						<table>
							<tr><td width="100">&nbsp;</td><td align="right" width="70">Sub Total</td><td align="right" width="50"><?php echo $default_sales['price']; ?></td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">GST(18%)</td><td align="right" width="50"><?php echo $gst=$default_sales['price']*0.18; ?></td></tr>
							<tr><td colspan="3"><hr style="width:300px; margin-top:-1px;"></hr></td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">Total</td><td align="right" width="100"><?php echo $total_price=$default_sales['price']+$gst; ?></td></tr>
							<tr><td colspan="3"><hr style="width:300px; margin-top:-2px;"></hr></td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">Previous Paid</td><td align="right" width="100"><?php echo $default_sales['price']-$default_sales['balance']; ?></td></tr>
							<tr><td colspan="3"><hr style="width:300px; margin-top:-2px;"></hr></td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">Paying Now</td><td align="right" width="100"><?php echo $paid_amount=$_POST['paying_now']; ?></td></tr>
							<tr><td colspan="3"><hr style="width:300px; margin-top:-2px;"></hr></td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">Balance Due</td><td align="right" width="100"><?php echo $balance=$default_sales['balance']-$_POST['paying_now']+$gst; ?></td></tr>
							<tr><td colspan="3"><hr style="width:300px; margin-top:-2px;"></hr></td></tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="section footer">
			<div class="container">
				<div class="row">
					<div class="t_n_c">
						<p>
						<h3 style="font-family:Times New Roman, Serif;">Terms &amp; Conditions</h3>				
						<ol>
							<li style="font-size:12px;" > Subject to TRAI Rules & Regulations.</li>
							<li style="font-size:12px;">Subject To termination charges.</li>
							<li style="font-size:12px;">All Disputes are subject to Delhi Jurisdiction.</li>
							<li style="font-size:12px;">The Payments received after due date will attract a inter of 1.25% per month.</li>
						</ol>
						</p>
						<p class="footer_note" style="font-size:12px;">
							Note-Payment to be made in favour of 
							"B2BEnquiry.com" 
							A/C Nu- 112505500641, 
							Bank Name-ICICI Bank Ltd. ,
							Branch Name- Uttam Nagar New Delhi 110059,
							IFSC Code- ICIC0001125 on or before activation of services . 
							
							THIS IS COMPUTER GENERATED INVOICE AND REQUIRES NO STAMP AND SIGNATURE. 
							PAN Num.AAUCS0452P
							</p>
					</div>
				</div>
			</div>
		</div>	
		</div>
	
	</body>
</html>

<?php 
$status='';
if ($balance==0) {
	$status="Not Active";
}
else{
	$status='active';
}
insert("invoices",array('cid'=>$cid,'status'=>$status,'total_price'=>$total_price,'paid_amount'=>$paid_amount,'balance'=>$balance));
$balance_without_gst=$balance-$gst;
sqlfetch("UPDATE sale_done SET balance='$balance_without_gst' WHERE cid='$cid'");
 ?>