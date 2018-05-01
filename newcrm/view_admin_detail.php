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
		<?php 
		$admin_id=$_GET['admin_id'];
		$admin_data=sqlfetch("SELECT * FROM `admin` where id='$admin_id'");
		foreach($admin_data as $admin){
		?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Employee Details</h3>
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
                    <h2><?=get_admin_name_by_id($_GET['admin_id']);?> <small>Complete report</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?=get_admin_photo_by_admin_id($_GET['admin_id']);?>" alt="<?=get_admin_name_by_id($_GET['admin_id']);?> Photo" title="<?=get_admin_name_by_id($_GET['admin_id']);?>">
                        </div>
                      </div>
                      <h3><?=get_admin_name_by_id($admin_id);?></h3>
						<p>(<?=get_admin_role_text_by_admin_id($admin_id);?>)</p>
                      <ul class="list-unstyled user_data">
                        <li>
							<?php if($admin['phone']){ ?> <i class="fa fa-phone user-profile-icon"></i> <?=$admin['phone'];?><br> <?php } ?>
							<?php if($admin['email']){ ?> <i class="fa fa-envelope user-profile-icon"></i> <?=$admin['email'];?><br> <?php } ?>
							
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?=get_admin_role_text_by_admin_id($admin_id);?>
                        </li>
                      </ul>

                      <a href="add_admin.php?pid=<?=$_GET['admin_id'];?>&edit=true" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">All Clients</a>
                          </li>
                          <li role="presentation" class=""><a href="#erp_chat" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">ERP Chat</a>
                          </li>
                          <li role="presentation" class=""><a href="#proposal" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Proposal</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
							<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
						  <thead>
							<tr>
							  <th>Name</th>
							  <th>Company Name</th>
							  <th>Email</th>
							  <th>Phone</th>
							  <th>Status</th>
							  <th>Action</th>
							</tr>
						  </thead>


						  <tbody>
							<?php 
							$admin_role_id=get_admin_role_id(get_admin_id());
								$total_data=total_data_erp($admin_id);
								if(count($total_data))
								{
									$total_data_list=implode(',',$total_data);
								$customer_query="Select * FROM customer where id in ($total_data_list)";				
							// echo $customer_query;
							$customer_data=sqlfetch($customer_query);
							// echo count($customer_data);
							if(count($customer_data))
								foreach($customer_data as $customer)
								{ 
								?>
									
								
							<tr>
							  <td><a target="_blank" href="view_customer_detail.php?cid=<?=$customer['id'];?>"><?=$customer['name'];?></a></td>
							  <td><?=$customer['c_name'];?></td>
							  <td><?=$customer['email'];?></td>
							  <td><?=$customer['phone'];?></td>
							  <td><?=get_erp_status($customer['id']) ? get_sales_category_stat_text(get_erp_status($customer['id'])) : 'NA';?></td>
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
								}
								
							?>
							
						  </tbody>
						</table>
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
								$cgroup_data=sqlfetch("SELECT * FROM erp_chat where sales_id='$admin_id' order by id desc");
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
									<div class="col-md-3">
										<label>Next Date</label>
										<?=date('d M Y H:i', strtotime($cgroup['nextdate']));?>
									</div>
									<div class="col-md-3">
										<label>Status</label>
										<?=get_sales_category_stat_text($cgroup['status']);?>
									</div>
									<div class="col-md-3">
										<label>Sale Person</label>
										<a href="view_admin_detail.php?admin_id=<?=$cgroup['sales_id'];?>">
										<?=get_admin_name_by_id($cgroup['sales_id']);?></a>
									</div>
									<div class="col-md-3">
										<label>Client</label>
										<a href="<?=SITE_URL;?>view_customer_detail.php?cid=<?=$cgroup['cid'];?>"><?=get_customer_name($cgroup['cid']);?></a>
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
								<td>To</td>
								<td>Subject</td>
								<td>View</td>
							</tr>
						</thead>
						<!--<button onclick="refresh_proposal_list()">Refresh</button>-->
						<tbody id="proposal_list">
							<?php 
							$proposal_sql=sqlfetch("Select * FROM proposal WHERE admin_id='$admin_id' order by id desc");
							if(count($proposal_sql))
								foreach($proposal_sql as $proposal_data)
								{ ?>	
							<tr>
								<td><?=$proposal_data['date'];?></td>
								<td><a href="<?=SITE_URL;?>view_customer_detail.php?cid=<?=$proposal_data['cid'];?>"><?=get_customer_name($proposal_data['cid']);?></a></td>
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