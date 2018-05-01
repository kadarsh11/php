<?php include('function/function.php');
$umessage='';
check_session();

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
						<h2>Sales Employee</small></h2>
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
						  
						</p>
						
						<div class="clearfix clear-both"></div>
						<br/>
						<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
						  <thead>
							<tr>
							 <!-- <th><input type="checkbox" id="check-all" class="flat"></th>-->
							  <th>Name</th>
							  <th>Email &amp; Phone</th>
							  <th>Matured</th>
							  <th>Commited</th>
							  <th>Follow Up</th>
							  <th>Not Interested</th>
							  <th>Total Calls</th>
							  <th>Action</th>
							</tr>
						  </thead>


						  <tbody>
							<?php 
							$admin_role_id=get_admin_role_id(get_admin_id());
							
								// echo 'Yes';
								$admin_id=get_admin_id();
								$customer_arr=array();
								$sales_employee_list=sqlfetch("Select * FROM `admin` where admin_role_id='2'");
								if(count($sales_employee_list))
								foreach($sales_employee_list as $sales_employee_list_data)
								{ ?>
									
							<tr>
							  <!--<td><input type="checkbox" value="<?=$sales_employee_list_data['id'];?>" class="flat" name="table_records[]"></td>-->
							  <td><?=$sales_employee_list_data['fname'].' '.$sales_employee_list_data['lname'];?></td>
							  <td><?=$sales_employee_list_data['email'].'<br>'.$sales_employee_list_data['phone'];?></td>
							  <!-- Matured Calls (1)-->
							  <td><a target="_blank" href="sales_report_detail.php?admin_id=<?=$sales_employee_list_data['id'];?>&date=<?=date('Y-m-d');?>&status=1"><?=today_status_calls_by_mem($sales_employee_list_data['id'],1,date('Y-m-d'));?></a></td>
							  <!-- Committed Calls (2)-->
							  <td><a target="_blank" href="sales_report_detail.php?admin_id=<?=$sales_employee_list_data['id'];?>&date=<?=date('Y-m-d');?>&status=2"><?=today_status_calls_by_mem($sales_employee_list_data['id'],2,date('Y-m-d'));?></a></td>
							  <!-- Matured Calls (3)-->
							  <td><a target="_blank" href="sales_report_detail.php?admin_id=<?=$sales_employee_list_data['id'];?>&date=<?=date('Y-m-d');?>&status=3"><?=today_status_calls_by_mem($sales_employee_list_data['id'],3,date('Y-m-d'));?></a></td>
							  <!-- Total Calls-->
							  <td><a target="_blank" href="sales_report_detail.php?admin_id=<?=$sales_employee_list_data['id'];?>&date=<?=date('Y-m-d');?>&status=4"><?=today_status_calls_by_mem($sales_employee_list_data['id'],5,date('Y-m-d'));?></a></td>
							  <!-- Total Calls-->
							  <td><?=total_calls_by_mem($sales_employee_list_data['id'],date('Y-m-d'));?></td>
							  <td>
								<a target="_blank" href="sales_report_detail.php?admin_id=<?=$sales_employee_list_data['id'];?>&date=<?=date('Y-m-d');?>"><i class="fa fa-eye pull-left"></i></a>
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