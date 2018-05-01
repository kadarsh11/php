<?php include('function/function.php');
$umessage='';
check_session();

if(isset($_POST['deleteall']))
{
	$arr=$_POST['table_records'];
	if(count($arr))
	{
	$str_rest_refs=implode(",",$arr);
	
	$data=sqlfetch("select * from `invoices` where id in ($str_rest_refs)");
		foreach($data as $category)
		{
			@$img_path='../upload/'.$category['photo'];
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
		}
	
	$pdo=getPDOObject();
	$q=$pdo->query("DELETE FROM `invoices` WHERE id in ($str_rest_refs)");
	if($q)
	$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Deleted Successfully
						   </div>';	
	}
	else{
		$umessage='<div class="alert alert-danger" role="alert">
							<strong></strong>Please Select Items to perform this action
						   </div>'; 
	}
}

if(isset($_POST['activate']))
{
	$arr=$_POST['table_records'];
	if(count($arr))
	{
		$str_rest_refs=implode(",",$arr);
		$pdo=getPDOObject();
	$q=$pdo->query("UPDATE `invoices` SET actstat='1' WHERE id in ($str_rest_refs)");
	if($q)
	$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Activated Successfully
						   </div>';	
	}
	else{
		$umessage='<div class="alert alert-danger" role="alert">
							<strong></strong>Please Select Items to perform this action
						   </div>'; 
	}
		
}	

if(isset($_POST['deactivate']))
{
	$arr=$_POST['table_records'];
	if(count($arr))
	{
		$str_rest_refs=implode(",",$arr);
		$pdo=getPDOObject();
	$q=$pdo->query("UPDATE `invoices` SET actstat='0' WHERE id in ($str_rest_refs)");
	if($q)
	$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>DeActivated Successfully
						   </div>';	
	}
	else{
		$umessage='<div class="alert alert-danger" role="alert">
							<strong></strong>Please Select Items to perform this action
						   </div>'; 
	}	
}

function invoice_form($cid,$inv_no='###',$take_tax=18,$no_of_services=3)
{ 
if($inv_no==='###' and $take_tax)
$inv_no=get_auto_increment('invoices');
?>

	<style>
			.invoice_det_bottom table{float:right; width:250px; margin-top:20px; margin-left:100px; font-size:11px;}
			
			.particulars table{ border: 1px solid #d8d8d7; font-family:sans-serif; font-size:11px; text-align:center; height:130px; border-collapse:collapse; width:100%;}
			.particulars table tr th{border: 1px solid #d8d8d7; font-weight:550; padding:7px;}
			.particulars table tr td{border:1px solid #d8d8d7; padding:10px;  font-size:10px;}
			body { font-family: calibri; padding:2px; font-size:14px; }
			.section { width: 100%; float:left; display:block;  }
			.main_container{ width:2480px; max-width:100%; height: 1754px; margin:0 auto; padding:30px; box-shadow:0px 0px 5px  #CCC; }
			.container { width:2480px; max-width:100%; text-align:left; margin:0 auto; } 
			.head_left { width:50%; float:left; text-align:left; } 
			.head_left { width:50%; float:left; text-align:left; } 
			.logo_img  { width:400px; margin:0; margin-left:20px; }
			.header  { border-bottom:1px solid #CCC; margin-bottom:15px; }
			.header span { color:skyblue; position:absolute; top:0px; font-weight:700; padding:4px; background:white; font-size:15px; }
			.head_right { width:50%; float:right; text-align:right; padding-top:10px; } 
			.head_right h3 { margin: 0; letter-spacing: 0px; font-size: 20px; }
			.head_right p { font-size:9px; }
			.invoice_det_left { float:left; width:50%; font-size:10px; }
			.invoice_det_right { float:right; width:50%; font-size:10px; text-align:right; }
			.invoice_det_right table { float:right; font-size:10px; }
			.invoice_det_right table th { text-align:left; padding-right:20px; height:14px; line-height:1.2;}
			.invoice_det_right table tr { line-height:30px; height:30px;}
			
			.footer_note { text-align:center; } 
		</style>
	<?php 
			$invoice_customer_detail=sqlfetch("Select * FROM `customer` where id='$cid'"); 
			if(count($invoice_customer_detail))
				foreach($invoice_customer_detail as $invoice_customer)
				{
					$default_customer=$invoice_customer;
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
					<p style="font-size:9px;">11-A,Gulab Bagh, Opposite Metro Pillar No. 736,<br>
						Near by Nawada Metro Station,<br>
						Uttam Nagar, New Delhi<br>
						Delhi - 110059<br>
						India</p>
						<?php if($take_tax){ ?>
					<p>GSTIN 07EGVPK8784C1ZN</p>
						<?php } ?>
				</div>
			</div>
			<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($take_tax){ ?>TAX<?php } ?> INVOICE</span>
		</div>
		<div class="section invoice_det">
			<div class="container">
				<div class="row">
					<div class="invoice_det_left">
					<span>Bill To</span>
					<p style="font-size:10px; font-family:sans-serif;">
						<strong style="font-size:12;"><input type="text" name="invoice_to_text" value="<?=$default_customer['c_name'] ? $default_customer['c_name']: 'NA';?>"/></strong><br>
						<?=$default_customer['addr'];?><br>
						<?=$default_customer['city'];?><br>
						<?=$default_customer['state'];?>-<?=$default_customer['zip'];?><br>
						<?=$default_customer['country'];?><br>
						<br>
						<?php if($take_tax){ ?>
						<input type="text" name="gst_num" placeholder="GST Number" />
						<?php  } ?>
						<br>
						<br>
						Place of Supply: Delhi
					</p>
					</div>
					<div class="invoice_det_right">
						<table align="right" style="font-size:10px;">
							<tr><th>Tax Invoice#</th><td><?=$inv_no;?></td></tr>
							<tr><th>Date</th><td><?=$dated;?></td></tr>
							<tr><th>Payment Terms</th><td>Due on Receipt</td></tr>
							<tr><th>Payment Due Date</th><td>14 July 2017</td></tr>
							<tr><th>Quotation Ref. No.#</th><td>Komal</td></tr>
							<tr><th>Sale Person Name</th><td>Komal-7210018919</td></tr>
						
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
								<th align="right" width="70">CGST</th>
								<th align="right" width="70">SGST</th>
								<th align="right" width="100">Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Renewal Of Website</td><br>
								<td>3 Google App E-mail IDs, Domain, Hosting, Maintenance</td><br>
								<td>1yr</td>
								<td align="right" width="70">6210.00</td>
								<td align="right" width="70">558.9<br>9%</td>
								<td align="right" width="70">558.9<br>9%</td>
								<td align="right" width="100">6210.0%</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Renewal Of Website</td><br>
								<td>3 Google App E-mail IDs, Domain, Hosting, Maintenance</td><br>
								<td>1yr</td>
								<td align="right" width="70">6210.00</td>
								<td align="right" width="70">558.9<br>9%</td>
								<td align="right" width="70">558.9<br>9%</td>
								<td align="right" width="100">6210.0%</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Renewal Of Website</td><br>
								<td>3 Google App E-mail IDs, Domain, Hosting, Maintenance</td><br>
								<td>1yr</td>
								<td align="right" width="70">6210.00</td>
								<td align="right" width="70">558.9<br>9%</td>
								<td align="right" width="70">558.9<br>9%</td>
								<td align="right" width="100">6210.0%</td>
							</tr>
							<tr>
								<td>1</td>
								<td>Renewal Of Website</td><br>
								<td>3 Google App E-mail IDs, Domain, Hosting, Maintenance</td><br>
								<td>1yr</td>
								<td align="right" width="70">6210.00</td>
								<td align="right" width="70">558.9<br>9%</td>
								<td align="right" width="70">558.9<br>9%</td>
								<td align="right" width="100">6210.0%</td>
							</tr>
							
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
						
							<tr><td width="100">&nbsp;</td><td align="right" width="70">Sub Total</td><td align="right" width="50">6210.00</td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">CGST(9%)</td><td align="right" width="50">558.00</td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">SGST(9%)</td><td align="right" width="100">558.00</td></tr>
							<tr><td colspan="3"><hr style="width:300px; margin-top:-1px;"></hr></td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">Total</td><td align="right" width="100">Rs.7327.80</td></tr>
							<tr><td colspan="3"><hr style="width:300px; margin-top:-2px;"></hr></td></tr>
							<tr><td width="10">&nbsp;</td><td align="right" width="70">Previous Paid</td><td align="right" width="100">Rs.0.00</td></tr>
							<tr><td colspan="3"><hr style="width:300px; margin-top:-2px;"></hr></td></tr>
							
							<tr><td width="10">&nbsp;</td><td align="right" width="70">Balance Due</td><td align="right" width="100">Rs.7327.80</td></tr>
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
	
	
	<?php
}

?><?php include('include/header.php');?>
<!-- Bootstrap -->
<!-- Datatables -->
    <link href="<?=SITE_URL;?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL;?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL;?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL;?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL;?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <?php include('include/sidebar.php'); ?>
        
		</div>

        <!-- top navigation -->
        <?php include('include/top.php'); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
			<div class="">
				<div class="row">
				  <div class="col-md-12 col-sm-12 col-xs-12">
				  <?=$umessage;?>
					<div class="x_panel">
					  <div class="x_title">
						<h2>Invoice Manager</small></h2>
						<ul class="nav navbar-right panel_toolbox">
						  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						  </li>
						  <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
							  <li><a href="#">Settings 1</a>
							  </li>
							  <li><a href="#">Settings 2</a>
							  </li>
							</ul>
						  </li>
						  <li><a class="close-link"><i class="fa fa-close"></i></a>
						  </li>
						</ul>
						<div class="clearfix"></div>
					  </div>
					  <div class="x_content">
	
	<?php 
	if(isset($_REQUEST['sid']))
	{
		$sid=$_REQUEST['sid'];
		$sale_data=sqlfetch("Select * FROM `sale_done` where id='$sid'");
		// echo count($sale_data);
		if(count($sale_data))
		{
			foreach($sale_data as $sale)
			{		
				invoice_form($sale['cid']);
			}
		}
		
	}	
	?>
	
						
					  </div>
					</div>
				  </div>					
					
				</div>
			</div>
		</div>
        <!-- /page content -->

        <!-- footer content -->
       <?php include('include/footer.php'); ?>
	       <!-- jQuery -->
<script src="./vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="./vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="./vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="./vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="./vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="./vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="./vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="./vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="./vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="./vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="./vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="./vendors/jszip/dist/jszip.min.js"></script>
    <script src="./vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="./vendors/pdfmake/build/vfs_fonts.js"></script>
	
	
	
	<script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
		<script type="text/javascript">
    function toggle(source) {
        var aInputs = document.getElementsByTagName('input');
        for (var i=0;i<aInputs.length;i++) {
            if (aInputs[i] != source && aInputs[i].className == source.className) {
                aInputs[i].checked = source.checked;
            }
        }
    }
 </script>