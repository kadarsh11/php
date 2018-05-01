<?php include('function/function.php');
$umessage='';
check_session();
$pid=$_GET['pid'];
?><?php include('include/header.php');?>
<!-- Bootstrap -->
<!-- Datatables -->
    <link href="<?=SITE_URL;?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL;?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL;?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL;?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?=SITE_URL;?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <body>
    <div class="container body">
      <div class="main_container">
		<?php 
							$proposal_sql=sqlfetch("Select * FROM proposal WHERE id='$pid' ");
							if(count($proposal_sql))
								foreach($proposal_sql as $proposal_data)
								{ ?>	
			<div class="">
				<div class="row">
				  <div class="col-md-12 col-sm-12 col-xs-12">
				  <?=$umessage;?>
					<div class="x_panel">
					  <div class="x_title">
						<h2>Proposal Details</small></h2>
						<div class="clearfix"></div>
					  </div>
					  <div class="x_content">
						<p class="text-muted font-13 m-b-30">
						  
						</p>
						
						<div class="clearfix clear-both"></div>
						<div class="row">
							<div class="col-md-12">
								<label>From : </label><?=$proposal_data['msg_from'];?>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<label>To : </label><?=$proposal_data['msg_to'];?>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<label>Date : </label><?=$proposal_data['date'];?>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<label>Client Name : </label><a href="<?=SITE_URL;?>view_customer_detail.php?cid=<?=$proposal_data['cid'];?>"><?=get_customer_name($proposal_data['cid']);?>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<label>Sale Person Name : </label><a href="view_admin_detail.php?admin_id=<?=$proposal_data['admin_id'];?>"><?=get_admin_name_by_id($proposal_data['admin_id']);?></a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Subject : </label><?=$proposal_data['msg_sub'];?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Message: </label><br><br>
								<?=htmlspecialchars_decode(html_entity_decode($proposal_data['msg_package_description']));?>
							</div>
						</div>
					  </div>
					</div>
				  </div>					
					
				</div>
			</div>
				<?php 
								}
								?>
        <!-- /page content -->

        <!-- footer content -->
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