<?php 
$umessage='';
include('./function/function.php'); 
check_session();
if(isset($_POST['addtax_class']))
{
	$id=0;
	extract($_POST);
	$pdo=getPDOObject();
	$posted_data=$_POST;
	// $sql=getRows('tbl_category',array('fld_category_name'=>$fld_category_name));
	// $sql=$pdo->query("SELECT * FROM `tax_class` where  name LIKE '$name'");
	// $num=$sql->rowCount();
	// @$photos=$_FILES['fld_image']['name'];
	// $Filename='';
	
	// Duplicate Crosscheck Overrided as there was no need
	$num=0;
	
	if(!$num)
	{	
		if($photos){
		$Filename=date('dmyhis').basename( $_FILES['fld_image']['name']);		
			$posted_data['fld_image']=$Filename;	
				$target = "./upload/".$Filename;
				move_uploaded_file($_FILES['fld_image']['tmp_name'], $target);    //Tells you if its all ok	
		}
		
				// $services_id[]=implode(',',$services_id);
				$affected_rows=insert('tax_class',$posted_data);
				
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
	
	$data=sqlfetch("select * from `tax_class` where id in ($str_rest_refs)");
		foreach($data as $category)
		{
			$img_path='../upload/'.$category['photo'];
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
		}
	
	$pdo=getPDOObject();
	$q=$pdo->query("DELETE FROM `tax_class` WHERE id in ($str_rest_refs)");
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
	 $affected_rows=update('tax_class',$posted_data,array('id'=>$pid));
	
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Updated Successfully
						   </div>';
	
}


function tax_class_form($pid='0',$admin_id=0,$amt='0.00',$formname='addtax_class')
{ ?>
	<form class="form-horizontal" id="rform" method="post" enctype="multipart/form-data">
 <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
                    <div class="row">
                        <div class="col-md-11 col-sm-12 col-md-pull-1">
                            
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12">Select Employee</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
								  <select class="select2_multiple form-control" name="admin_id">
									<?php 
									$admin_id_data=sqlfetch("select * from `admin` where actstat='1' and admin_role_id in (2) ");
								if(count($admin_id_data))
									foreach($admin_id_data as $admin_ids)
									{
										$select='';
									if($admin_ids['id']==$admin_id)
										$select='selected="selected"';
									 ?>
									 <option <?php echo $select; ?>  value="<?php echo $admin_ids['id']; ?>"> <?=$admin_ids['fname']; ?> <?=$admin_ids['lname']; ?> (<?=get_admin_role_text_by_admin_id($admin_ids['id']);?>) (<?=$admin_ids['phone'];?>)</option>
									<?php
									}
									?>
								  </select>
								</div>
							</div>
							
                            <div class="form-group"><label class="col-md-4 control-label" for="amt">Amount</label>

                                <div class="col-lg-8"><input id="amt" value="<?=$amt;?>" name="amt" class="form-control" type="text">

                                </div>
                            </div>
							
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-offset-2 col-lg-10">

                                    <button name="<?=$formname; ?>" class="btn btn-primary " type="submit" id="submit"><i class="fa fa-check"></i> Save</button> | <a href="<?=SITE_URL;?>view_tax_class.php">Or Cancel</a>
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
                    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px">tax_class</h2>
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
                <h5>Edit tax_class</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>
			<?php 
			$pid=$_GET['pid'];
			$tax_class_data=sqlfetch("SELECT * FROM `tax_class` where id='$pid' ");
			foreach($tax_class_data as $tax_class)
			{
				extract($tax_class);
                tax_class_form($pid,$name,$services_id,$max_no_of_product,$max_no_of_enquiry,$des,$actstat,$fld_order,$price,$formname='editdone');
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
                <h5>Add tax_class</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>

                <?php tax_class_form();?>
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
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
		
		$('#des').summernote({
			height: "200px"
		});
		
		
	});
    </script>
    <!-- /Select2 -->