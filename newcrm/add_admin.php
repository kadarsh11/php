<?php 
$umessage='';
include('./function/function.php'); 
check_session();
if(isset($_POST['addadmin']))
{
	$id=0;
	extract($_POST);
	$pdo=getPDOObject();
	$posted_data=$_POST;
	// $sql=getRows('tbl_category',array('fld_category_name'=>$fld_category_name));
	$sql=$pdo->query("SELECT * FROM `admin` where  phone LIKE '$phone'");
	$num=$sql->rowCount();
	@$photos=$_FILES['photo']['name'];
	$Filename='';
	if(!$num)
	{	
		if($photos){
		$Filename=date('dmyhis').basename( $_FILES['photo']['name']);		
			$posted_data['photo']=$Filename;	
				$target = "./upload/".$Filename;
				move_uploaded_file($_FILES['photo']['tmp_name'], $target);    //Tells you if its all ok	
		}
				$affected_rows=insert('admin',$posted_data);
				
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
	
	$data=sqlfetch("select * from `admin` where id in ($str_rest_refs)");
		foreach($data as $category)
		{
			$img_path='../upload/'.$category['photo'];
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
		}
	
	$pdo=getPDOObject();
	$q=$pdo->query("DELETE FROM `admin` WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `admin` SET actstat='1' WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `admin` SET actstat='0' WHERE id in ($str_rest_refs)");
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
	@$photos=$_FILES['photo']['name'];
	if($photos!='')
	{	$Filename='';
		
		$Filename=date('dmyhis').basename( $_FILES['photo']['name']);		
		$posted_data['photo']=$Filename;
				$target = "./upload/".$Filename;
				move_uploaded_file($_FILES['photo']['tmp_name'], $target);    //Tells you if its all ok	
				@$img_path='./upload/'.$prevphoto;
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
				
		}
		
	 $affected_rows=update('admin',$posted_data,array('id'=>$pid));
	
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Updated Successfully
						   </div>';
	
}


function admin_form($pid='0',$fname='',$lname='',$email='',$password='',$phone='',$photo='',$other_info='',$admin_role_id='',$position='',$uplead_id='',$team_id='',$actstat=0,$formname='addadmin')
{ ?>
	<form class="form-horizontal" id="rform" method="post" enctype="multipart/form-data">
 <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group"><label class="col-md-4 control-label" for="fname">First Name<small class="red">*</small> </label>

                                <div class="col-lg-8"><input id="name" value="<?=$fname;?>" name="fname" class="form-control" autofocus="" type="text">

                                </div>
                            </div>
							<div class="form-group"><label class="col-md-4 control-label" for="lname">Last Name<small class="red"></small> </label>

                                <div class="col-lg-8"><input id="name" value="<?=$lname;?>" name="lname" class="form-control"  type="text">

                                </div>
                            </div>
							

                            <div class="form-group"><label class="col-md-4 control-label" for="email">Email</label>

                                <div class="col-lg-8"><input id="email" required value="<?=$email;?>" name="email" class="form-control" type="text">

                                </div>
                            </div>
							
							<div class="form-group"><label class="col-md-4 control-label" for="password">Password<small class="red">*</small> </label>

                                <div class="col-lg-8"><input id="name" value="<?=$password;?>" name="password" class="form-control" required  type="text">

                                </div>
                            </div>
							
                            <div class="form-group"><label class="col-md-4 control-label" for="phone">Phone</label>

                                <div class="col-lg-8"><input id="phone" required value="<?=$phone;?>" name="phone" class="form-control" type="text">

                                </div>
                            </div>
                            <div class="form-group"><label class="col-md-4 control-label" for="photo">Photo</label>

                                <div class="col-lg-8"><input id="photo" value="<?=$photo;?>" name="photo" class="form-control" type="file">
								<img src="./upload/<?=$photo;?>" class="img-responsive" style="max-width:200px; max-height:200px;" />
                                </div>
                            </div>
							
							<!--
                            <div class="form-group"><label class="col-md-4 control-label" for="tags">Tags</label>

                                <div class="col-lg-8">
                                    
                                    <select name="tags[]" id="tags" <?//=$tags;?> class="form-control select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true">
                                    </select>
                                </div>
                            </div>
							-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group"><label class="col-md-4 control-label" for="group">Group</label>

                                <div class="col-lg-8">
                                    <select class="form-control" name="admin_role_id" id="admin_role_id">
                                        <option value="0">None</option>
                                        <?php $cgroup_data=sqlfetch("Select * FROM admin_roles where actstat='1'");
										if(count($cgroup_data))
										foreach($cgroup_data as $cgroup)
										{
										$select='';
										if($admin_role_id==$cgroup['id'])
											$select='selected';
										?>
											<option <?=$select; ?> value="<?=$cgroup['id'];?>"><?=$cgroup['name'];?></option>
											<?php 
										}
										?>
                                    </select>
                                </div>
                            </div>
							
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12">Select Uplead</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
								  <select class="select2_multiple form-control" name="uplead_id" multiple="multiple">
								  <option value="0">None</option>
									<?php 
									$admin_id_data=sqlfetch("select * from `admin` where actstat='1' ");
								if(count($admin_id_data))
									foreach($admin_id_data as $admin_id)
									{
										$select='';
									if($admin_id['id']==$uplead_id)
										$select='selected="selected"';
									 ?>
									 <option <?php echo $select; ?>  value="<?php echo $admin_id['id']; ?>"> <?=$admin_id['fname']; ?> <?=$admin_id['lname']; ?> (<?=$admin_id['phone'];?>)</option>
									<?php
									}
									?>
								  </select>
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
							
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-offset-2 col-lg-10">

                                    <button name="<?=$formname; ?>" class="btn btn-primary " type="submit" id="submit"><i class="fa fa-check"></i> Save</button> | <a href="<?=SITE_URL;?>view_admin.php">Or Cancel</a>
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
    <link href="./vendors/select2/dist/css/select2.min.css" rel="stylesheet">
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

            <div class="row wrapper white-bg page-heading">
                <div class="col-lg-12">
                    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px"> Contacts </h2>

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
                <h5>Edit User</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>
			<?php 
			$pid=$_GET['pid'];
			$admin_data=sqlfetch("SELECT * FROM `admin` where id='$pid' ");
			foreach($admin_data as $admin)
			{
				extract($admin);
                admin_form($pid,$fname,$lname,$email,$password,$phone,$photo,$other_info,$admin_role_id,$position,$uplead_id,$team_id,$actstat,$formname='editdone');
				
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
                <h5>Add Admin</h5>

            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>

                <?php admin_form();?>
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
          maximumSelectionLength: 1,
          placeholder: "With Max Selection limit 1",
          allowClear: true
        });
		
		$('#des').summernote({
			height: "200px"
		});
		
		
	});
    </script>
    <!-- /Select2 -->