<?php include('function/function.php');
$umessage='';
check_session();

if(isset($_POST['deleteall']))
{
	$arr=$_POST['table_records'];
	if(count($arr))
	{
	$str_rest_refs=implode(",",$arr);
	
	$data=sqlfetch("select * from `sale_done` where id in ($str_rest_refs)");
		foreach($data as $category)
		{
			@$img_path='../upload/'.$category['photo'];
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
		}
	
	$pdo=getPDOObject();
	$q=$pdo->query("DELETE FROM `sale_done` WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `sale_done` SET actstat='1' WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `sale_done` SET actstat='0' WHERE id in ($str_rest_refs)");
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
						<h2>Sale Done List</small></h2>
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
						<p class="text-muted font-13 m-b-30">
						  
						</p>
						
						<form action="" method="post" >
						<div class="form-group">
								
							<span class="col-md-2 pull-right">
								<button type="submit" name="activate" class="btn btn-success"><i class="fa"></i>Activate</button>
							</span>
							<span class="col-md-2 pull-right">
								<button type="submit" name="deactivate" class="btn btn-default"><i class="fa"></i> Deactivate</button>
							</span>	
							<span class="col-md-2 pull-right">
								<button type="submit" name="deleteall" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
							</span>
						</div>
						<div class="clearfix clear-both"></div>
						<br/>
						<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
						  <thead>
							<tr>
							  <th><input type="checkbox" id="check-all" class="flat"></th>
							  <th>Client Name</th>
							  <th>Sales Person</th>
							  <th>Dated</th>
							  <th>Price</th>
							  <th>Activation Stat</th>
							  <th>Package</th>
							  <th>Action</th>
							</tr>
						  </thead>


						  <tbody>
							<?php 
							$sale_done_data=sqlfetch("SELECT * FROM sale_done order by id desc");
							if(count($sale_done_data))
								foreach($sale_done_data as $sale_done)
								{ ?>
							<tr>
							  <td><input type="checkbox" value="<?=$sale_done['id'];?>" class="flat" name="table_records[]"></td>
							  <td><?=get_customer_name($sale_done['cid']);?></td>
							  <td><?=get_admin_name_by_id($sale_done['sales_id']);?></td>
							  <td><?=date('d M Y H:i', strtotime($sale_done['dated']));?></td>
							  <td><?=$sale_done['price'];?></td>
							  <td><?=get_active_status_text($sale_done['actstat']);?></td>
							  <td><?=get_package_name($sale_done['package']);?></td>
							  <td>
								<a href="add_sale_done.php?pid=<?=$sale_done['id'];?>&edit=true"><i class="fa fa-pencil pull-left"></i></a>
								<a title="Invoices" href="manage_invoices.php?sid=<?=$sale_done['id'];?>"><i class="fa fa-file-pdf-o pull-right"></i></a>
							  </td>
							</tr>
							<?php
								}
							?>
							
						  </tbody>
						</table>
						</form>
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