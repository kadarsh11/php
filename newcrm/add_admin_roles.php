<?php 
$umessage='';
include('./function/function.php'); 
check_session();
if(isset($_POST['addadmin_roles']))
{
	$id=0;
	$privilege=array();
	extract($_POST);
	$pdo=getPDOObject();
	$posted_data=$_POST;
	// $sql=getRows('tbl_category',array('fld_category_name'=>$fld_category_name));
	$sql=$pdo->query("SELECT * FROM `admin_roles` where  name LIKE '$name'");
	$num=$sql->rowCount();
	@$photos=$_FILES['fld_image']['name'];
	$Filename='';
	if(!$num)
	{	
		if($photos){
		$Filename=date('dmyhis').basename( $_FILES['fld_image']['name']);		
			$posted_data['fld_image']=$Filename;	
				$target = "./upload/".$Filename;
				move_uploaded_file($_FILES['fld_image']['tmp_name'], $target);    //Tells you if its all ok	
		}
		
				$privilege[]=implode(',',$privilege);
				$affected_rows=insert('admin_roles',$posted_data);
				
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

if(isset($_POST['deleteall']))
{
	$arr=$_POST['ids'];
	if(count($arr))
	{
	$str_rest_refs=implode(",",$arr);
	
	$data=sqlfetch("select * from `admin_roles` where id in ($str_rest_refs)");
		foreach($data as $category)
		{
			$img_path='../upload/'.$category['photo'];
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
		}
	
	$pdo=getPDOObject();
	$q=$pdo->query("DELETE FROM `admin_roles` WHERE id in ($str_rest_refs)");
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
	$arr=$_POST['ids'];
	if(count($arr))
	{
		$str_rest_refs=implode(",",$arr);
		$pdo=getPDOObject();
	$q=$pdo->query("UPDATE `admin_roles` SET actstat='1' WHERE id in ($str_rest_refs)");
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
	$arr=$_POST['ids'];
	if(count($arr))
	{
		$str_rest_refs=implode(",",$arr);
		$pdo=getPDOObject();
	$q=$pdo->query("UPDATE `admin_roles` SET actstat='0' WHERE id in ($str_rest_refs)");
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
	$privilege=array();
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
		@$privilege=implode(',',$privilege);
			$posted_data['privilege']=$privilege;
			// print_r($posted_data);
	 $affected_rows=update('admin_roles',$posted_data,array('id'=>$pid));
	
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Updated Successfully
						   </div>';
	
}


function admin_roles_form($pid='0',$name='',$privilege='',$actstat=1,$fld_order=0,$formname='addadmin_roles')
{ ?>
	<form class="form-horizontal" id="rform" method="post" enctype="multipart/form-data">
 <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                    <div class="row">
                        <div class="col-md-11 col-sm-12 col-md-pull-1">
                            <div class="form-group"><label class="col-md-4 control-label" for="name">Name<small class="red">*</small> </label>

                                <div class="col-lg-8"><input id="name" value="<?=$name;?>" name="name" class="form-control" autofocus="" type="text">

                                </div>
                            </div>
							
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12">Select Privileges</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									
									<table class="table table-responsive table-stripped">
									<!--<tr>
										<td colspan="1">
											<label>Select *</label>
											<input type="checkbox" class="form-control xyz" onclick="toggle(this)"/>
										</td>
									</tr>
									-->
									<tr>
										<td>Table Name</td>
										<td>Add</td>
										<td>Delete</td>
										<td>Update</td>
										<td>View</td>
									</tr>
									<?php 
									$privileges=explode(',',$privilege);
									$privilege_data=sqlfetch("select * from `access_db`");
								if(count($privilege_data))
									foreach($privilege_data as $privilege_item)
									{
										$checked1=$checked2=$checked3=$checked4='';
									if(in_array($privilege_item['adding'],$privileges))
										$checked1='checked="checked"';
									if(in_array($privilege_item['deleting'],$privileges))
										$checked2='checked="checked"';
									if(in_array($privilege_item['updating'],$privileges))
										$checked3='checked="checked"';
									if(in_array($privilege_item['viewing'],$privileges))
										$checked4='checked="checked"';
									 ?>
									 <tr>
									 
									 <td><?php echo $privilege_item['tbl_name']; ?></td>
									 <td><input type="checkbox" <?php echo $checked1; ?> name="privilege[]" class="js-switch" value="<?php echo $privilege_item['adding']; ?>" /></td>
									 <td><input type="checkbox" <?php echo $checked2; ?> name="privilege[]" class="js-switch" value="<?php echo $privilege_item['deleting']; ?>" /></td>
									 <td><input type="checkbox" <?php echo $checked3; ?> name="privilege[]" class="js-switch" value="<?php echo $privilege_item['updating']; ?>" /></td>
									 <td><input type="checkbox" <?php echo $checked4; ?> name="privilege[]" class="js-switch" value="<?php echo $privilege_item['viewing']; ?>" /></td>
									 </tr>
									<?php
									}
									?>
								  </table>
								</div>
							</div>

                            
                            <div class="form-group"><label class="col-md-4 control-label" for="phone">Activation</label>

                                <div class="col-lg-2">
									<select name="actstat" class="form-control" id="selectError" data-rel="chosen">
										<option <?php if(($actstat)=='1')echo 'selected'; ?> value="1">Active</option>
										<option <?php if(($actstat)=='0')echo 'selected'; ?> value="0">Inactive</option>
									</select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-md-4 control-label" for="address">Sort Order</label>

                                <div class="col-lg-2"><input id="fld_order" value="<?=$fld_order;?>" name="fld_order" class="form-control" type="number">

                                </div>
                            </div>
							
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-offset-2 col-lg-10">

                                    <button name="<?=$formname; ?>" class="btn btn-primary " type="submit" id="submit"><i class="fa fa-check"></i> Save</button> | <a href="<?=SITE_URL;?>view_admin_roles.php">Or Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            
	
<?php 
}

?>
<?php include('include/header.php'); ?>

<!-- Select2 -->
    <link href="<?=SITE_URL;?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	<!-- Switchery -->
    <link href="<?=SITE_URL;?>vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <?php include('include/sidebar.php'); ?>
		</div>
        <!-- top navigation -->
        <?php include('include/top.php'); ?>
		<!-- /top navigation -->
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
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row wrapper white-bg page-heading">
                <div class="col-lg-12">
                    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px">admin_roles</h2>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeIn">
                

<div class="wrapper wrapper-content">
<div class="row">

    <div class="col-md-12">


<?php 
if(isset($_GET['edit']) and ($_GET['edit']=='true'))
{ ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Edit admin_roles</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>
			<?php 
			$pid=$_GET['pid'];
			$admin_roles_data=sqlfetch("SELECT * FROM `admin_roles` where id='$pid' ");
			foreach($admin_roles_data as $admin_roles)
			{
				extract($admin_roles);
                admin_roles_form($pid,$name,$privilege,$actstat,$fld_order,$formname='editdone');
			}
			?>
			</div>
        </div>
<?php 

}
else{
	?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add admin_roles</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>

                <?php admin_roles_form();?>
			</div>
        </div>
		
	<?php 
}
?>
    </div>
</div>


</div>

<input name="_msg_add_new_group" id="_msg_add_new_group" value="Add New Group" type="hidden">
<input name="_msg_group_name" id="_msg_group_name" value="Group Name" type="hidden">

<div id="ajax-modal" class="modal container fade-scale" tabindex="-1" style="display: none;"></div>
</div>
        
</div>

<?php include('include/footer.php'); ?>

<!-- Switchery -->
    <script src="<?=SITE_URL;?>vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
    <script src="<?=SITE_URL;?>vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="<?=SITE_URL;?>vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->

<!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Select a state",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          // maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
		
		$('#des').summernote({
			height: "200px"
		});
		
		
	});
    </script>
    <!-- /Select2 -->