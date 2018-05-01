<?php include('function/function.php');
check_session();
$umessage='';
if(isset($_POST['chat_submit']))
{
	$id=0;
	extract($_POST);
	$pdo=getPDOObject();
	$posted_data=$_POST;
	// $sql=getRows('tbl_category',array('fld_category_name'=>$fld_category_name));
				// echo $update_data['nextdate']=$nextdate;
	
	$sql=$pdo->query("SELECT * FROM `erp_chat` where  remarks LIKE '$remarks' and nextdate LIKE '$nextdate'  ");
	$num=$sql->rowCount();
	
	$Filename='';
	if(!$num)
	{	
		
		// if(($status==1) and !(is_numeric($package))
				$posted_data['sales_id']=get_admin_id();
				// $services_id[]=implode(',',$services_id);
				$affected_rows=insert('erp_chat',$posted_data);
				
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Added Successfully
						   </div>';
						   
				$update_data['status']=$status;
				$nextdate=date('Y-m-d H:i:s',strtotime($nextdate));
				$update_data['next_follow']=$nextdate;
				update('sales_data_assign',$update_data,array('cid'=>$cid));
				
				
		if($status==1)
		{
			$sale_done=$posted_data;
			if($price=='' or $price<=0)
			$sale_done['price']=get_package_price($package);
			$sale_done['balance']=$sale_done['price'];
			$sale_done['sales_id']=get_admin_id();
			$sale_done['actstat']=0;
			$sale_done['package']=$package;
			$sale_done['des']=$posted_data['remarks'];
			
			$affected_rows=insert('sale_done',$sale_done);
			if($affected_rows)
				$umessage.='<div class="alert alert-success" role="alert">
						<strong></strong>Sale Logged Successfully
						</div>';
				header('location:./');
		}
						   
	}
	else
	{
		$umessage='<div class="alert alert-danger" role="alert">Duplicate Entry!!! Code Already Exists </div> ';
	}
	
}
?>
<?php include('include/header.php');?>
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
			<div class="page-title">
              <div class="title_left">
                <h3>Sales Chat</h3>
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
				<?=$umessage;?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Sales Chat<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
									<?php
				$customer_id=$_GET['cid'];
				$customer_data=sqlfetch("Select * FROM customer where id='$customer_id'");
				if(count($customer_data))
				foreach($customer_data as $customer)
					{ ?>
					
						Company Name: <label class="control-label"><?=$customer['c_name'];?></label>
						&nbsp;&nbsp;&nbsp;&nbsp;
						Client Name: <label><?=$customer['name'];?></label>
						&nbsp;&nbsp;&nbsp;&nbsp;
						Phone No: <label><?=$customer['phone'];?></label>
						&nbsp;&nbsp;&nbsp;&nbsp;
						Email ID: <label><?=$customer['email'];?></label>
					<form id="demo-form2" onsubmit="return validate_mature();" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
					<input type="hidden" name="cid" value="<?=$customer_id; ?>">
					
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Type<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
							<select class="form-control col-md-7 col-xs-12" required name="status" id="status" >
							<?php

								$category_type_data = sqlfetch("SELECT * FROM sales_category_type where !(id='4') order by fld_order ");
								if(count($category_type_data))
								foreach($category_type_data as $category_type)
								{
									$select='';
									if($category_type['id']==get_sales_category_from_erp_chat($customer_id))
									$select='selected';
								?>
								<option value="<?php echo $category_type['id']; ?>" <?=$select; ?> ><?php echo $category_type['name'];?></option>
								<?php }
								?>
							</select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Next Follow up Date<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input id="next_date" name="nextdate" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Remarks</label>
                        <div class="col-md-10 col-sm-8 col-xs-12">
                          <textarea class="summernote" id="remarks" name="remarks" cols="60" rows="10"></textarea><br />
								<script>
									var postForm = function() {
									var content = $('textarea[name="remarks"]').html($('.summernote').code());
									}
								</script>
                        </div>
                      </div>
                      
					  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Package<span class="required"></span><small>(Select if Matured)</small>
                        </label>
                        <div class="col-md-4 col-sm-10 col-xs-12">
							<select class="form-control col-md-7 col-xs-12" required name="package" id="package" >
								<option>Select Package</option>
							<?php

								$package_type_data = sqlfetch("SELECT * FROM package ");
								if(count($package_type_data))
								foreach($package_type_data as $package_type)
								{
								?>
								<option value="<?php echo $package_type['id']; ?>" <?=$select; ?> ><?php echo $package_type['name'];?></option>
								<?php }
								?>
							</select>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Price<span class="required"></span><small>(Fill if Matured)</small>
                        </label>
                        <div class="col-md-4 col-sm-10 col-xs-12">
							<input type="text" id="price" name="price" placeholder="00.00" class="form-control"/>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Take Tax<span class="required"></span><small>(Fill if Matured)</small>
                        </label>
                        <div class="col-md-4 col-sm-10 col-xs-12">
							<select name="take_tax" class="form-control">
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
                        </div>
                      </div>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="./"><button type="button" class="btn btn-primary">Cancel</button></a>
                          <button type="submit" name="chat_submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
					<?php }?>
                  </div>
                </div>
              </div>
            
			
<script>
function validate_mature()
{
var client_type=document.getElementById('status').value;
var pakage_selected=document.getElementById('package').value;
var price=document.getElementById('price').value;
	if(client_type==1)
	{
		if(pakage_selected=='')
		{
			alert('You Must Select a Package Before You Proceed ');
			return false;
		}
		else if(pakage_selected>0)
		{
			return true;
		}
		else
		{
			alert('You Must Select a Package Before You Proceed ');
			return false;	
		}
	}
	else
	{
		return true;
	}
	return false;
}


</script>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="x_panel" id="package_details">
				<div id="loader" style="float:none; z-index:100; display:none; position:absolute;  width:96%; height:96%;" >
					<img src="progress.gif" style="width:100%; object-fit:cover; height:100%;" >
				</div>
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Packages <small>Float left</small></h2>
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
					<div class="col-md-12" id="msg_stat">
						<div id="msg_stat_success" style="display:none;" class="alert alert-success alert-dismissable">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Success!</strong> Proposal Sent Successfully
						</div>
						<div id="msg_stat_failure" style="display:none;" class="alert alert-danger alert-dismissable">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Failure!</strong> Proposal Cannot be sent
						</div>
						
					</div>
                    <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">
                        <?php $pakage_data=sqlfetch("Select * FROM package where actstat='1'");
						$i=0;
						if(count($pakage_data))
							foreach($pakage_data as $pakage)
							{ 
							if($i==0)
								$class='class="active"';
							else
								$class='';
							?>
						<li <?=$class;?>><a href="#home_<?=$i;?>" data-toggle="tab"><?=$pakage['name'];?></a>
                        </li>
						<?php $i++;
							}?>
                      </ul>
                    </div>

                    <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
						<?php $pakage_data=sqlfetch("Select * FROM package where actstat='1'");
						$i=0;
						if(count($pakage_data))
							foreach($pakage_data as $pakage)
							{
							if($i==0)
								$active='active';
							else
								$active='';
							?>
                        <div class="tab-pane <?=$active;?>" id="home_<?=$i;?>">
							<label>To (Only Mail ID Comma ',' Separated)</label>
							<input type="text" class="form-control msg_to_" value="<?=$customer['email'];?>" id="msg_to_<?=$i;?>" name="msg_to_<?=$i;?>"/><br>
							<label>From</label>
							<input type="text" class="form-control msg_from_" readonly value="<?=get_admin_email(get_admin_id());?>" id="msg_from_<?=$i;?>" name="msg_from_<?=$i;?>"/><br>
							<label>Subject</label>
							<input type="text" class="form-control msg_sub_" value="Proposal from Metaphor IT" id="msg_sub_<?=$i;?>" name="msg_sub_<?=$i;?>"/><br>
							<textarea class="package_description_" id="package_description_<?=$i;?>" id="package_description_<?=$i;?>" name="package_description_<?=$i;?>"><p><?=$pakage['des'];?></p></textarea>
								<br/>
							<button class="btn btn-submit btn-info" onclick="CKupdate(); send_proposal(<?=$i;?>)">Send Proposal</button>
                        </div>
						<?php
						$i++;
							}
							$textarea_num=$i;
							?>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="x_panel" id="package_details">
				<div id="loader" style="float:none; z-index:100; display:none; position:absolute;  width:96%; height:96%;" >
					<img src="progress.gif" style="width:100%; object-fit:cover; height:100%;" >
				</div>
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Proposals</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-xs-12">
                      <table class="table table-striped table-bordered bulk_action">
						<thead>
							<tr>
								<td>Date</td>
								<td>View</td>
							</tr>
						</thead>
						<!--<button onclick="refresh_proposal_list()">Refresh</button>-->
						<tbody id="proposal_list">
							<?php 
							$proposal_sql=sqlfetch("Select * FROM proposal WHERE cid='$customer_id' order by id desc ");
							if(count($proposal_sql))
								foreach($proposal_sql as $proposal_data)
								{ ?>	
							<tr>
								<td><?=$proposal_data['date'];?></td>
								<td><a target="_blank" href="<?=SITE_URL?>proposal_detail.php?pid=<?=$proposal_data['id'];?>"><i class="fa fa-eye"></i></a></td>
							</tr>
								<?php
								}
							?>
						</tbody>
                      </table>
                    </div>
                    <div class="clearfix"></div>

                  </div>
                </div>
              </div>

			</div>
		
				
				  
			<div class="clearfix"></div>
			
			<div class="row">
				  <div class="col-md-12 col-sm-12 col-xs-12">
		
					<div class="x_panel">
					  <div class="x_title">
						<h2>Previous Chat</h2>
						<div class="clearfix"></div>
					  </div>
					  <div class="x_content">
						<p class="text-muted font-13 m-b-30">
						  
						</p>
						
						<form action="" method="post" >
						
						<div class="clearfix clear-both"></div>
						<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
						  <thead>
							<tr>
							  <th>Date</th>
							  <th>Chat Description</th>
							</tr>
						  </thead>


						  <tbody>
							<?php 
							$cgroup_data=sqlfetch("SELECT * FROM erp_chat where cid='$customer_id' order by id desc");
							if(count($cgroup_data))
								foreach($cgroup_data as $cgroup)
								{ ?>
							<tr>
							  <td>
									<?=$cgroup['tdate'];?>
							  </td>
							  <td>
							  <div class="row">
								<div class="col-md-12">
									<?=html_entity_decode($cgroup['remarks']);?>
								</div>
							  </div>
							  <div class="row">
								<div class="col-md-4">
									<label>Next Date</label>
									<?=date('d M Y h:i A', strtotime($cgroup['nextdate']));?>
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
						</form>
					  </div>
					</div>
				  </div>					
			

			</div>
			
			</div>
			
		</div>
		<!-- /page content -->
<?php $m_on_call=1;?>
        <!-- footer content -->
       <?php include('include/footer.php'); ?>
	   <!-- bootstrap-daterangepicker -->
	   
	   <script src="<?=SITE_URL;?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script async src="<?=SITE_URL;?>vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/jszip/dist/jszip.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/pdfmake/build/pdfmake.min.js"></script>
    <script async src="<?=SITE_URL;?>vendors/pdfmake/build/vfs_fonts.js"></script>
	
	<script>
				function CKupdate(){
					for ( instance in CKEDITOR.instances )
						CKEDITOR.instances[instance].updateElement();
				}
				function get_ajaxvar()
				{
					var xmlhttp;
					if (window.XMLHttpRequest)
					  {// code for IE7+, Firefox, Chrome, Opera, Safari
					  xmlhttp=new XMLHttpRequest();
					  }
					else
					  {// code for IE6, IE5
					  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					  return xmlhttp;
				}
				
				function refresh_proposal_list()
				{
					var cid=<?=$_GET['cid'];?>;
					var xmlhttp=get_ajaxvar();
					xmlhttp.onreadystatechange=function()
					{

						if(xmlhttp.readyState==4 && xmlhttp.status==200)
						{
								document.getElementById('proposal_list').innerHTML=xmlhttp.responseText
						}		
					}
					xmlhttp.open("GET","function/ajax_proposal_list.php?cid="+cid,true);
					xmlhttp.send();
				}
				
				function send_proposal(prop_id)
				{
					CKupdate();
					document.getElementById('loader').style.display = 'block';
					var cid='<?=$_GET['cid'];?>';
					var msg_to_arr=document.getElementsByClassName('msg_to_');
					var msg_from_arr=document.getElementsByClassName('msg_from_');
					var msg_sub_arr=document.getElementsByClassName('msg_sub_');
					var package_description_arr=document.getElementsByClassName('package_description_');
					
					var msg_to=encodeURIComponent(msg_to_arr[prop_id].value);
					var msg_from=encodeURIComponent(msg_from_arr[prop_id].value);
					var msg_sub=encodeURIComponent(msg_sub_arr[prop_id].value);
					var msg_package_description=encodeURIComponent(package_description_arr[prop_id].value);
					var xmlhttp=get_ajaxvar();
					xmlhttp.onreadystatechange=function()
					{

						if(xmlhttp.readyState==4 && xmlhttp.status==200)
						{
							if(xmlhttp.responseText=='ok')
							{
								document.getElementById('loader').style.display = 'none';
								window.location='#package_details';
								document.getElementById("msg_stat_success").style.display='block';
								refresh_proposal_list();
							}	
							else
							{
								document.getElementById('loader').style.display = 'none';
								window.location='#package_details';
								document.getElementById("msg_stat_failure").style.display='block';
								refresh_proposal_list();
							}		
						}		
					}
			  // var guest_email = document.getElementById("guestemail").value;
				xmlhttp.open("POST","function/ajax_proposal_mail.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("cid="+cid+"&admin_id=<?=get_admin_id();?>&msg_to="+msg_to+"&msg_from="+msg_from+"&msg_sub="+msg_sub+"&msg_package_description="+msg_package_description+"&sendmail=1");
				}
				
				
				</script>
				
    <script>
      $(document).ready(function() {
        $('#next_date').daterangepicker({
			timePicker: true,
          timePickerIncrement: 1,
          locale: {
            format: 'MM/DD/YYYY h:mm A'
          },
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
		
		
		
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
		
		
      });
    </script>
	