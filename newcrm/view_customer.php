<?php include('function/function.php');
$umessage='';
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

if(isset($_POST['deleteall']))
{
	$arr=$_POST['table_records'];
	if(count($arr))
	{
	$str_rest_refs=implode(",",$arr);
		
	$pdo=getPDOObject();
	$q=$pdo->query("DELETE FROM `customer` WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `customer` SET actstat='1' WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `customer` SET actstat='0' WHERE id in ($str_rest_refs)");
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


if(isset($_POST['editdone']))
{
	extract($_POST);
	$posted_data=$_POST;
	// $posted_data['fld_id']=$pid;
	@$Filename=$prevphoto;
	@$photos=$_FILES['fld_image']['name'];
	if($photos!='')
	{	$Filename='';
		
		$Filename=date('dmyhis').basename( $_FILES['fld_image']['name']);		
		$posted_data['fld_image']=$Filename;
				$target = "../upload/".$Filename;
				move_uploaded_file($_FILES['fld_image']['tmp_name'], $target);    //Tells you if its all ok	
				$img_path='../upload/'.$prevphoto;
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
				
		}
		
	 $affected_rows=update('customer',$posted_data,array('id'=>$pid));
	
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Updated Successfully
						   </div>';
	
}



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
						<h2>Client List</small></h2>
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
							<?php if((in_array('37',$get_admin_access_arr))){ ?>
							<label class="control-label col-md-1 col-sm-1 col-xs-12">Forward to Sales</label>
							<span class="col-md-3">
								<select class="form-control" name="sales_member">
									<option>SELECT Sales Member</option>
									<?php
									$sales_team_data=sqlfetch("SELECT * FROM admin  where admin_role_id='2' order by position ");
									if(count($sales_team_data))
										foreach($sales_team_data as $sales_team)
										{ ?>
											<option value="<?=$sales_team['id'];?>"><?=$sales_team['fname'];?></option>
											<?php
										}
									?>
								</select>
							</span>
							<span class="col-md-2">
								<button class="btn btn-warning" value="true" name="forward_to_sales">Forward</button>
							</span>
							<?php } ?>
							<?php if((in_array('18',$get_admin_access_arr))){ ?>
							<span class="col-md-2 pull-right">
								<button name="deleteall" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
							</span>
							<? } ?>
						</div>
						<div class="clearfix clear-both"></div>
						<br/>
						<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
						  <thead>
							<tr>
							  <th><input type="checkbox" id="check-all" class="flat"></th>
							  <th>Name</th>
							  <th>Company Name</th>
							  <th>Email</th>
							  <th>Phone</th>
							  <th>City</th>
							  <th>Verification</th>
							  <th>Date Added</th>
							  <th>Action</th>
							</tr>
						  </thead>


						  <tbody>
							<?php 
							$admin_role_id=get_admin_role_id(get_admin_id());
							$customer_query="SELECT * FROM customer order by id desc";
							
							if(!($admin_role_id=='1') and !($admin_role_id=='2'))
							{
								// echo 'Yes';
								$admin_id=get_admin_id();
								$customer_arr=array();
								$new_data_list_data=sqlfetch("Select * FROM `new_data_list` where admin_id='$admin_id'");
								if(count($new_data_list_data))
								{
									
									foreach($new_data_list_data as $new_data_list)
									$customer_arr[]=$new_data_list['cid'];
								}
								$customer_str=implode(',',$customer_arr);
								$customer_query="SELECT * FROM `customer` where id in ($customer_str) and !(verify_stat='1') order by id desc";
							}
							if($admin_role_id=='6')
								$customer_query="Select * FROM customer where verify_stat='0'";
							if($admin_role_id=='2')
							{
								$total_data=total_data_erp(get_admin_id());
								if(count($total_data))
								{
									$total_data_list=implode(',',$total_data);
								$customer_query="Select * FROM customer where id in ($total_data_list)";								
								}
							}
							// echo $customer_query;
							$customer_data=sqlfetch($customer_query);
							// echo count($customer_data);
							if(count($customer_data))
								foreach($customer_data as $customer)
								{ 
								?>
									
								
							<tr>
							  <td><input type="checkbox" value="<?=$customer['id'];?>" class="flat" name="table_records[]"></td>
							  <td><a target="_blank" href="view_customer_detail.php?cid=<?=$customer['id'];?>"><?=$customer['name'];?></a></td>
							  <td><?=$customer['c_name'];?></td>
							  <td><?=$customer['email'];?></td>
							  <td><?=$customer['phone'];?></td>
							  <td><?=$customer['city'];?></td>
							  <td><?=get_verify_status_text($customer['verify_stat']);?></td>
							  <td><?=$customer['date_added'];?></td>
							  <td>
								<?php if($admin_role_id==2)
								{ ?>
								<a href="saleoncall.php?cid=<?=$customer['id'];?>"><i class="fa fa-phone pull-left"></i></a>
									<?php 
								}
								else
								{ ?>
								<a href="add_customer.php?pid=<?=$customer['id'];?>&edit=true"><i class="fa fa-pencil pull-left"></i></a>
									<?php 
								}?>
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