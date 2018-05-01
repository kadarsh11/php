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
		<?php 
		$cid=$_GET['cid'];
		$customer_data=sqlfetch("SELECT * FROM `customer` where id='$cid'");
		foreach($customer_data as $customer){
		?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Client Details</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?=get_customer_name($_GET['cid']);?> <small>Complete report</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="images/user.png" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?=$customer['c_name'];?></h3>
					  <span><strong><?=$customer['name'];?></strong></span>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> 
							<?=$customer['addr'];?>,<br>
							<?php if($customer['city']){ ?> <?=$customer['city'];?>,<br> <?php } ?>
							<?php if($customer['state']){ ?> <?=$customer['state'];?>,<br> <?php } ?>
							<?php if($customer['zip']){ ?> <?='ZIP- '.$customer['zip'];?>,<br> <?php } ?>
							<?php if($customer['country']){ ?> <?=$customer['country'];?><br> <?php } ?>
							
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?=get_customer_category($customer['id']);?>
                        </li>
                      </ul>

                      <a href="add_customer.php?pid=<?=$_GET['cid'];?>&edit=true" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                          </li>
                          <li role="presentation" class=""><a href="#erp_chat" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">ERP Chat</a>
                          </li>
                          <li role="presentation" class=""><a href="#proposal" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Proposal</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
							Not Applicable
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="erp_chat" aria-labelledby="profile-tab">

                            <table class="table table-striped table-bordered bulk_action">
							  <thead>
								<tr>
								  <th>Date</th>
								  <th>Chat Description</th>
								</tr>
							  </thead>
							  <tbody>
								<?php 
								$cgroup_data=sqlfetch("SELECT * FROM erp_chat where cid='$cid' order by id desc");
								if(count($cgroup_data))
									foreach($cgroup_data as $cgroup)
									{ ?>
								<tr>
								  <td style="width:25%;"><?=date('d M Y H:i', strtotime($cgroup['tdate']));?></td>
								  <td>
								  <div class="row">
									<div class="col-md-12">
										<?=html_entity_decode($cgroup['remarks']);?>
									</div>
								  </div>
								  <div class="row">
									<div class="col-md-4">
										<label>Next Date</label>
										<?=date('d M Y H:i', strtotime($cgroup['nextdate']));?>
									</div>
									<div class="col-md-4">
										<label>Status</label>
										<?=get_sales_category_stat_text($cgroup['status']);?>
									</div>
									<div class="col-md-4">
										<label>Sale Person</label>
										<?=get_admin_name_by_id($cgroup['sales_id']);?>
									</div>
								  </div>
								  
								  </td>
								</tr>
								<?php 
									}
								?>
								
							  </tbody>
							</table>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="proposal" aria-labelledby="profile-tab">
                            <table class="table table-striped table-bordered bulk_action">
						<thead>
							<tr>
								<td>Date</td>
								<td>Subject</td>
								<td>View</td>
							</tr>
						</thead>
						<!--<button onclick="refresh_proposal_list()">Refresh</button>-->
						<tbody id="proposal_list">
							<?php 
							$proposal_sql=sqlfetch("Select * FROM proposal WHERE cid='$cid' order by id desc");
							if(count($proposal_sql))
								foreach($proposal_sql as $proposal_data)
								{ ?>	
							<tr>
								<td><?=$proposal_data['date'];?></td>
								<td><?=$proposal_data['msg_sub'];?></td>
								<td><a target="_blank" href="<?=SITE_URL?>proposal_detail.php?pid=<?=$proposal_data['id'];?>"><i class="fa fa-eye"></i></a></td>
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
              </div>
            </div>
          </div>
        </div>
		<?php 
		}
		?>
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