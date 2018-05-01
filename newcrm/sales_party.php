<?PHP
ob_start();
error_reporting(E_ALL^E_NOTICE);

$option=$_GET['option'];
$page=$_GET['page'];

if(!isset($option) && !isset($page))
	$file_name="";

if(isset($option))
	$file_name='sales/'.$option.'/';
if(isset($page))
	 $file_name.=$page;
 
 
?>
<?php include('function/function.php');
check_session();

if(isset($_POST['forward_to_sales']))
{
	$id=0;
	extract($_POST);
	if(is_numeric($sales_member))
	{
		$assign_by=get_admin_id();
	$pdo=getPDOObject();
	$posted_data=$_POST;
	// print_r($_POST);
	// echo $str_rest_refs=implode(",",$table_records);
	if(is_array($table_records))
	{
		
		foreach($table_records as $cid)
		{
			// $sql=getRows('tbl_category',array('fld_category_name'=>$fld_category_name));
			$sql=$pdo->query("SELECT * FROM `sales_data_assign` where  cid LIKE '$cid' and assign_by LIKE '$assign_by'");
			$num=$sql->rowCount();
			@$photos=$_FILES['fld_image']['name'];
			$Filename='';
			if(!$num)
			{	
					$assign_to=$sales_member;
					$data_arr['cid']=$cid;
					$data_arr['assign_by']=$assign_by;
					$data_arr['assign_to']=$assign_to;
				$affected_rows=insert('sales_data_assign',$data_arr);
				
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Added Successfully
						   </div>';
			}
			else
			{
				$umessage='<div class="alert alert-danger" role="alert">Duplicate Entry!!! Code Already Exists </div> ';
			}
		}
	}
	}
	else{
		$umessage='<div class="alert alert-warning" role="alert">No Sales Team Member Selected!!!</div>';
	}
}

?>
<?php include('include/header.php');?>
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
			<?php include($file_name.'.php'); ?>
			
		</div>
        <!-- /page content -->

        <!-- footer content -->
		
		<!-- Datatables -->
    
       <?php include('include/footer.php'); ?>
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