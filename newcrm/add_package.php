<?php 
$umessage='';
include('./function/function.php'); 
check_session();
if(isset($_POST['addpackage']))
{
	$id=0;
	extract($_POST);
	$pdo=getPDOObject();
	$posted_data=$_POST;
	// $sql=getRows('tbl_category',array('fld_category_name'=>$fld_category_name));
	$sql=$pdo->query("SELECT * FROM `package` where  name LIKE '$name'");
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
		
				$services_id[]=implode(',',$services_id);
				$affected_rows=insert('package',$posted_data);
				
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
	
	$data=sqlfetch("select * from `package` where id in ($str_rest_refs)");
		foreach($data as $category)
		{
			$img_path='../upload/'.$category['photo'];
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
		}
	
	$pdo=getPDOObject();
	$q=$pdo->query("DELETE FROM `package` WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `package` SET actstat='1' WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `package` SET actstat='0' WHERE id in ($str_rest_refs)");
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
		$services_id=implode(',',$services_id);
			$posted_data['services_id']=$services_id;
	 $affected_rows=update('package',$posted_data,array('id'=>$pid));
	
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Updated Successfully
						   </div>';
	
}


function package_form($pid='0',$name='',$services_id=array(),$max_no_of_product='0',$max_no_of_enquiry='0',$des='',$actstat=1,$fld_order=0,$price='0.00',$formname='addpackage')
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
								<label class="control-label col-md-4 col-sm-4 col-xs-12">Select Services</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
								  <select class="select2_multiple form-control" name="services_id[]" multiple="multiple">
									<?php 
									$services_ids=explode(',',$services_id);
									$services_id_data=sqlfetch("select * from `services` where actstat='1' order by fld_order ");
								if(count($services_id_data))
									foreach($services_id_data as $services_id_item)
									{
										$select='';
									if(in_array($services_id_item['id'],$services_ids))
										$select='selected="selected"';
									 ?>
									 <option <?php echo $select; ?>  value="<?php echo $services_id_item['id']; ?>"> <?php echo $services_id_item['name']; ?> </option>
									<?php
									}
									?>
								  </select>
								</div>
							</div>

                            <div class="form-group"><label class="col-md-4 control-label" for="company">Features</label>

                                <div class="col-lg-8">
								<textarea class="summernote" id="editor1" name="des" cols="60" rows="10"><?php echo $des; ?></textarea><br />
                                </div>
                            </div>

                            <div class="form-group"><label class="col-md-4 control-label" for="email">Price</label>

                                <div class="col-lg-8"><input id="price" value="<?=$price;?>" name="price" class="form-control" type="text">

                                </div>
                            </div>
							<div class="form-group"><label class="col-md-4 control-label" for="max_no_of_enquiry">Max Enquiry</label>

                                <div class="col-lg-8"><input id="max_no_of_enquiry" value="<?=$max_no_of_enquiry;?>" name="max_no_of_enquiry" class="form-control" type="number">

                                </div>
                            </div>
							<div class="form-group"><label class="col-md-4 control-label" for="max_no_of_product">Max Product</label>

                                <div class="col-lg-8"><input id="max_no_of_product" value="<?=$max_no_of_product;?>" name="max_no_of_product" class="form-control" type="number">
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

                                    <button name="<?=$formname; ?>" class="btn btn-primary " type="submit" id="submit"><i class="fa fa-check"></i> Save</button> | <a href="<?=SITE_URL;?>view_package.php">Or Cancel</a>
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
                    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px">package</h2>
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
                <h5>Edit Package</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>
			<?php 
			$pid=$_GET['pid'];
			$package_data=sqlfetch("SELECT * FROM `package` where id='$pid' ");
			foreach($package_data as $package)
			{
				extract($package);
                package_form($pid,$name,$services_id,$max_no_of_product,$max_no_of_enquiry,$des,$actstat,$fld_order,$price,$formname='editdone');
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
                <h5>Add Package</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>

                <?php package_form();?>
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
    <script src="./vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="./vendors/parsleyjs/dist/parsley.min.js"></script>
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
          // maximumSelectionLength: 4,
          //placeholder: "With Max Selection limit 4",
          allowClear: true
        });
		
	
		
		$('#des').summernote({
			height: "200px"
		});
		
	});
    </script>
    <!-- /Select2 -->