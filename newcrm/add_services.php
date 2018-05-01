<?php 
$umessage='';
include('./function/function.php'); 
check_session();
if(isset($_POST['addservices']))
{
	$id=0;
	extract($_POST);
	$pdo=getPDOObject();
	$posted_data=$_POST;
	// $sql=getRows('tbl_category',array('fld_category_name'=>$fld_category_name));
	$sql=$pdo->query("SELECT * FROM `services` where  name LIKE '$name'");
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
				$affected_rows=insert('services',$posted_data);
				
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
	
	$data=sqlfetch("select * from `services` where id in ($str_rest_refs)");
		foreach($data as $category)
		{
			$img_path='../upload/'.$category['photo'];
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
		}
	
	$pdo=getPDOObject();
	$q=$pdo->query("DELETE FROM `services` WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `services` SET actstat='1' WHERE id in ($str_rest_refs)");
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
	$q=$pdo->query("UPDATE `services` SET actstat='0' WHERE id in ($str_rest_refs)");
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
		
	 $affected_rows=update('services',$posted_data,array('id'=>$pid));
	
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Updated Successfully
						   </div>';
	
}


function service_form($pid='0',$name='',$features='',$actstat=1,$fld_order=0,$price='0.00',$formname='addservices')
{ ?>
	<form class="form-horizontal" id="rform" method="post" enctype="multipart/form-data">
 <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                    <div class="row">
                        <div class="col-md-10 col-sm-12 col-md-pull-2">
                            <div class="form-group"><label class="col-md-4 control-label" for="name">Name<small class="red">*</small> </label>

                                <div class="col-lg-8"><input id="name" value="<?=$name;?>" name="name" class="form-control" autofocus="" type="text">

                                </div>
                            </div>

                            <div class="form-group"><label class="col-md-4 control-label" for="company">Features</label>

                                <div class="col-lg-8">
								<textarea class="summernote" name="features" cols="60" rows="10"><?php echo $features; ?></textarea><br />
								<script>
								// var $my_summernote_jqr=jQuery.noConflict();
									$(document).ready(function() {
										$('.summernote').summernote({
											height: "200px"
										});
									});
									var postForm = function() {
									var content = $('textarea[name="features"]').html($('.summernote').code());
									}
								</script>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-md-4 control-label" for="email">Price</label>

                                <div class="col-lg-8"><input id="price" value="<?=$price;?>" name="price" class="form-control" type="text">

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

                                    <button name="<?=$formname; ?>" class="btn btn-primary " type="submit" id="submit"><i class="fa fa-check"></i> Save</button> | <a href="<?=SITE_URL;?>view_services.php">Or Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            
	
<?php 
}

?>
<?php include('include/header.php'); ?>
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
                    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px">Services</h2>
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
                <h5>Edit Service</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>
			<?php 
			$pid=$_GET['pid'];
			$services_data=sqlfetch("SELECT * FROM `services` where id='$pid' ");
			foreach($services_data as $services)
			{
				extract($services);
                service_form($pid,$name,$features,$actstat,$fld_order,$price,$formname='editdone');
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
                <h5>Add Service</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>

                <?php service_form();?>
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