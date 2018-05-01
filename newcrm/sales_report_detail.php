<?php include('function/function.php');
$umessage='';
check_session();
$conditions = array();
$conditions['where'] = array();

$erp_chat_data=sqlfetch("SELECT * FROM erp_chat order by id desc");
if(isset($_GET['admin_id']) and ($_GET['admin_id']!='') and (is_numeric($_GET['admin_id'])))
{
	$conditions['where']=array('sales_id'=>$_GET['admin_id']);
}
if(isset($_GET['cid']) and is_numeric($_GET['cid']))
{
	$get_cid=$_GET['cid'];
	$conditions['where']=array_merge(array('cid'=>$get_cid),$conditions['where']);
}
if(isset($_GET['date']) and ($_GET['date']!=''))
{
	$get_date=$_GET['date'];
	$conditions['like'][]="tdate LIKE '$get_date%'";
}
if(isset($_GET['status']) and (is_numeric($_GET['status'])))
{
	$status=$_GET['status'];
	$conditions['where']=array_merge(array('status'=>$status),$conditions['where']);
}
$erp_chat_data=getRows('erp_chat',$conditions);

?>
<?php include('include/header.php');?>
<!-- Bootstrap -->
<!-- Datatables -->
    <link href="./vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
						<h2>Sales Chat Report</small></h2>
						<ul class="nav navbar-right panel_toolbox">
						  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						  </li>
						  <li><a class="close-link"><i class="fa fa-close"></i></a>
						  </li>
						</ul>
						<div class="clearfix"></div>
					  </div>
					  <div class="x_content">
						<p class="text-muted font-13 m-b-30">
							<div class="row">
								<div class="col-md-3">Employee:- 
						  <?php if(isset($_GET['admin_id']) and is_numeric($_GET['admin_id'])){ echo ' <a target="_blank" href="'.SITE_URL.'view_admin_detail.php?admin_id='.$_GET['admin_id'].'">'.get_admin_name_by_id($_GET['admin_id']).'</a>';}?>
								</div>
								<div class="col-md-3">Client Name:-
						  <?php if(isset($_GET['cid'])){ echo ' <a target="_blank" href="'.SITE_URL.'view_customer_detail.php?cid='.$_GET['cid'].'">'.@get_customer_name($_GET['cid']).'</a>'; } ?>
								</div>
								<div class="col-md-3">Date:- 
						  <?php if(isset($_GET['date'])){ echo 'Date:'.$_GET['date']; } ?>
								</div>
								<div class="col-md-3">Status:-
						  <?php if(isset($_GET['status'])){ echo ''.get_sales_category_stat_text($_GET['status']); } ?>
								</div>
							</div>
							<div class="row">
								<form method="get" action="">
								<div class="col-md-3">
									<select name="admin_id" onchange="form.submit();" class="form-control">
										<option value="">SELECT Sales Member</option>
									<?php
									$sales_team_data=sqlfetch("SELECT * FROM admin  where admin_role_id='2' order by position ");
									$current_sales_id=$_GET['admin_id'];
									if(count($sales_team_data))
										foreach($sales_team_data as $sales_team)
										{ ?>
											<option <?php if($sales_team['id']==$current_sales_id) echo 'selected'; ?> value="<?=$sales_team['id'];?>"><?=$sales_team['fname'];?></option>
											<?php
										}
									?>
									</select>
						  
								</div>
								<div class="col-md-3">
									<select class="form-control" name="cid" onchange="form.submit();" >
										<option value="" >Select Customer</option>
									<?php $customer_select_data=sqlfetch("SELECT id,c_name from customer where verify_stat='1' order by date_added desc");
									if(count($customer_select_data))
										foreach($customer_select_data as $customer_select) { ?>
										<option <?php if($_GET['cid']==$customer_select['id']) echo 'selected';?> value="<?=$customer_select['id'];?>"><?=$customer_select['c_name'];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-3">
									<input type="text" placeholder="YYYY-MM-DD" id="reportrange" onblur="form.submit();" class="form-control" name="date" value="<?=@$_GET['date'];?>" />
								</div>
								<div class="col-md-3">
									<select name="status" class="form-control" onchange="form.submit();">
										<option value="">Not Set</option>
										<?php $status_select_data=sqlfetch("select * from `sales_category_type` where actstat='1' order by fld_order asc");
										@$current_status=$_GET['status'];
										if(count($status_select_data))
											foreach($status_select_data as $status_select){ ?>
										<option <?php if($status_select['id']==$current_status) echo 'selected';?> value="<?=$status_select['id'];?>"><?=$status_select['name'];?></option>
											<?php } ?>
									</select>
								</div>
							</div>
						</p>
						<p>
						<!--<h4>Filters</h4>
						<form action="<?=$_SERVER['REQUEST_URI'];?>" method="">
							<label class="control-label col-md-1 col-sm-1 col-xs-12">Sale Person</label>
							<span class="col-md-3">
								<select onchange="form.submit();" class="form-control" name="admin_id">
									<option>SELECT Sales Member</option>
									<?php
									$sales_team_data=sqlfetch("SELECT * FROM admin where admin_role_id='2' and actstat='1' order by position ");
									if(count($sales_team_data))
										foreach($sales_team_data as $sales_team)
										{ ?>
											<option <?php if(@$_GET['admin_id']==$sales_team['id'])echo 'selected';?> value="<?=$sales_team['id'];?>"><?=$sales_team['fname'];?></option>
											<?php
										}
									?>
								</select>
							</span>
							
						</form>
						-->
						</p>
						<div class="clearfix clear-both"></div>
						<br/>
						<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
						  <thead>
							<tr>
							  <th><input type="checkbox" id="check-all" onclick="toggle(this);"></th>
							  <th>Date</th>
							  <th>Next Date</th>
							  <th>Chat Description</th>
							</tr>
						  </thead>


						  <tbody>
							<?php 
							if(count($erp_chat_data))
								foreach($erp_chat_data as $erp_chat)
								{ ?>
							<tr>
							  <td><input type="checkbox" value="<?=$erp_chat['id'];?>" name="table_records[]"></td>
							  <td><?=$erp_chat['tdate'];?></td>
							  <td><?=$erp_chat['nextdate'];?></td>
							  <td>
								<label>Comments: </label><br><?=html_entity_decode($erp_chat['remarks']);?><br><br>
								<label>Sales Person : </label>
								<?=get_admin_name_by_id($erp_chat['sales_id']);?>
								<label>Status : </label>
								<?=get_sales_category_stat_text($erp_chat['status']);?>
								<label>Client : </label>
								<a href="view_customer_detail.php?cid=<?=$erp_chat['cid'];?>"><?=get_customer_name($erp_chat['cid']);?>
							  </td>
							  
							</tr>
							<?php 
								}
							?>
							
						  </tbody>
						</table>
						
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
	<!-- jquery.inputmask -->
    <script src="./vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
	
	
	<script>
      $(document).ready(function() {
		   $(":input").inputmask();
		   // $('#date_sale_chat').daterangepicker({
			  // singleDatePicker: true,
			  // calender_style: "picker_3",
			  // format: 'YYYY-MM-DD'
			// });
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