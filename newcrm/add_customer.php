<?php 
$umessage='';
include('./function/function.php'); 
check_session();
if(isset($_POST['addcustomer']))
{
	$id=0;
	extract($_POST);
	$pdo=getPDOObject();
	$posted_data=$_POST;
	// $sql=getRows('tbl_category',array('fld_category_name'=>$fld_category_name));
	$sql=$pdo->query("SELECT * FROM `customer` where  c_name LIKE '$c_name' or phone LIKE '$phone' or email LIKE '$email'");
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
				$affected_rows=insert('customer',$posted_data);
				
				$new_posted_data['cid']=$affected_rows['id'];
				$new_posted_data['admin_id']=get_admin_id();
				
				if(get_admin_role_id(get_admin_id())=='2')
				{
					$assign_to=get_admin_id();
					$data_arr['cid']=$affected_rows['id'];
					$data_arr['assign_by']=$assign_by;
					$data_arr['assign_to']=$assign_to;
					$affected_rows3=insert('sales_data_assign',$data_arr);
					update('customer',array('verify_stat'=>1),array('id'=>$affected_rows['id']));
					update('sales_data_assign',array('status'=>4),array('cid'=>$affected_rows['id']));
				}
				
				$affected_rows2=insert('new_data_list',$new_posted_data);
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
	
	$data=sqlfetch("select * from `customer` where id in ($str_rest_refs)");
		foreach($data as $category)
		{
			$img_path='../upload/'.$category['photo'];
			 if(file_exists($img_path))
			 { 
			   @unlink($img_path);
			 }
		}
	
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
	$arr=$_POST['ids'];
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
	$arr=$_POST['ids'];
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

if(isset($_POST['add_contact']))
{
	$duplicate_entry=0;
	$contacts_uploaded=0;
	$id=0;
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
}
	
	$handle = fopen($_FILES['filename']['tmp_name'], "r");
$firstRow = true;

while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {

	if($firstRow) { $firstRow = false; }
	else {
		
		$zero=0;
		
		$pdo=getPDOObject();
		$sql=$pdo->query("SELECT * FROM `customer` where c_name LIKE '$data[1]' or phone LIKE '$data[3]' or email LIKE '$data[2]'");
		$num=$sql->rowCount();
		if(!$num)
		{
			
			$posted_data['name']=$data[0];
			$posted_data['c_name']=$data[1];
			$posted_data['email']=$data[2];
			$posted_data['phone']=$data[3];
			$posted_data['addr']=$data[4];
			$posted_data['city']=$data[5];
			$posted_data['state']=$data[6];
			$posted_data['zip']=$data[7];
			$posted_data['country']=$data[8];
			$posted_data['nature_of_business']=$data[9];
			$posted_data['password']=$data[10];
			
			$affected_rows=insert('customer',$posted_data);
			if($affected_rows['id'])
			{
				$contacts_uploaded++;
				$new_posted_data['cid']=$affected_rows['id'];
				$new_posted_data['admin_id']=get_admin_id();
				$affected_rows2=insert('new_data_list',$new_posted_data);
			}
		}
		else
		{
			$duplicate_entry++;
		}
		$umessage='<div class="alert alert-success" role="alert">
						<strong></strong>Contacts Uploaded='.$contacts_uploaded.' , Duplicate Entry Avoided='.$duplicate_entry.'
					   </div>';
	}
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


if(isset($_POST['verify_this']))
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
		$posted_data['verify_stat']='1';
	 $affected_rows=update('customer',$posted_data,array('id'=>$pid));
		$updated_data['verified_by']=get_admin_id();
		update('new_data_list',$updated_data,array('cid'=>$pid) );
	
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Updated Successfully
						   </div>';
	
}
if(isset($_POST['unverify_this']))
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
		$posted_data['verify_stat']='2';
	 $affected_rows=update('customer',$posted_data,array('id'=>$pid));
		$updated_data['verified_by']=get_admin_id();
		update('new_data_list',$updated_data,array('cid'=>$pid) );
	
				// $affected_rows = $q->rowCount();
				if($affected_rows)
					$umessage='<div class="alert alert-success" role="alert">
							<strong></strong>Updated Successfully
						   </div>';
	
}


function category_form($pid='0',$name='',$c_name='',$email='',$phone='',$addr='',$country='',$c_group='0',$password='',$city='',$state='',$zip='',$nature_of_business='',$formname='addcustomer')
{ ?>

<script>
 function check_company_name(c_name){
var xmlhttp=getAjaxVariable();
 xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("company_name_help").innerHTML=xmlhttp.responseText;
    }
  }

  // var query1=document.getElementById('query1').value;

  xmlhttp.open("GET","function/ajax_add_customer_check.php?c_name="+c_name+"&q=company_name&searchajax=1",true);
  xmlhttp.send();
 }

 function check_email(email){
var xmlhttp=getAjaxVariable();
 xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("email_id_help").innerHTML=xmlhttp.responseText;
    }
  }

  // var query1=document.getElementById('query1').value;

  xmlhttp.open("GET","function/ajax_add_customer_check.php?email="+email+"&q=email&searchajax=1",true);
  xmlhttp.send();
 }
 function check_phone(phone){
var xmlhttp=getAjaxVariable();
 xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("phone_help").innerHTML=xmlhttp.responseText;
    }
  }

  // var query1=document.getElementById('query1').value;

  xmlhttp.open("GET","function/ajax_add_customer_check.php?phone="+phone+"&q=phone&searchajax=1",true);
  xmlhttp.send();
 }

</script>

					<?php
				global $get_admin_access_arr;

					if((in_array('17',$get_admin_access_arr)) and !(isset($_GET['edit']))){ ?>
					<table class="table table-bordered cl-pro-table" border="1" cellpadding="1" cellspacing="1" width="100%">
						<tr>
							<td>
								<form enctype='multipart/form-data' action='' method='post'>
									Import from CSV:<br />
									<input class="btn btn-info" size='50' type='file' name='filename'><br />
									<input class="btn btn-warning" type='submit' name='add_contact' value='Upload'>
								</form>
							</td>
						</tr>
                    </table>
					<?php } ?>
	<form class="form-horizontal" id="rform" method="post" enctype="multipart/form-data">
 <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" />
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group"><label class="col-md-4 control-label" for="account">Full Name<small class="red">*</small> </label>

                                <div class="col-lg-8"><input id="name" required value="<?=$name;?>" name="name" class="form-control" autofocus="" type="text"/>

                                </div>
                            </div>

                            <div class="form-group"><label class="col-md-4 control-label" for="company">Company Name</label>

                                <div class="col-lg-8"><input required id="company" value="<?=$c_name;?>" name="c_name" class="form-control" onblur="check_company_name(this.value)" type="text">
								 <span id="company_name_help" class="help-block"></span> 
                                </div>
                            </div>

                            <div class="form-group"><label class="col-md-4 control-label" for="email">Email</label>

                                <div class="col-lg-8"><input onblur="check_email(this.value)" id="email" required value="<?=$email;?>" name="email" class="form-control" type="text">
								 <span id="email_id_help" class="help-block"></span> 
                                </div>
                            </div>
                            <div class="form-group"><label class="col-md-4 control-label" for="phone">Phone</label>

                                <div class="col-lg-8"><input onblur="check_phone(this.value)" id="phone" required value="<?=$phone;?>" name="phone" class="form-control" type="text">
								 <span id="phone_help" class="help-block"></span> 
                                </div>
                            </div>
                            <div class="form-group"><label class="col-md-4 control-label" for="address">Address</label>

                                <div class="col-lg-8"><input id="address" value="<?=$addr;?>" name="addr" class="form-control" type="text">

                                </div>
                            </div>
							
							<div class="form-group"><label class="col-md-4 control-label" for="zip">ZIP/Postal Code </label>

                                <div class="col-lg-8"><input id="zip" value="<?=$zip;?>" name="zip" class="form-control" type="text">

                                </div>
                            </div>
							
                            
							<!--
                            <div class="form-group"><label class="col-md-4 control-label" for="tags">Tags</label>

                                <div class="col-lg-8">
                                    
                                    <select name="tags[]" id="tags" <?=$tags;?> class="form-control select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true">
                                    </select>
                                </div>
                            </div>
							-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group"><label class="col-md-4 control-label" for="group">Group</label>

                                <div class="col-lg-8">
                                    <select class="form-control" name="c_group" id="c_group">
                                        <option value="0">None</option>
                                        <?php $cgroup_data=sqlfetch("Select * FROM cgroup ");
										if(count($cgroup_data))
										foreach($cgroup_data as $cgroup)
										{ 
										$select='';
										if($c_group==$cgroup['id'])
											$select='selected';
										?>
											<option <?=$select; ?> value="<?=$cgroup['id'];?>"><?=$cgroup['name'];?></option>
											<?php 
										}
										?>
                                    </select>
                                    
                                </div>
                            </div>


                            <div class="form-group"><label class="col-md-4 control-label" for="password">Password</label>

                                <div class="col-lg-8"><input id="password" value="<?=$password;?>" name="password" class="form-control" type="password">

                                </div>
                            </div>
							
							<div class="form-group"><label class="col-md-4 control-label" for="country">Country</label>

                                <div class="col-lg-8">

									<select name="country" class="form-control" id="country" onchange="get_states(this.value)" >
								<option value="">Select Country</option>
						
						<?php $country_sql = sqlfetch("select DISTINCT `city_country` from `cities` order by `city_country` "); 
						if(count($country_sql))
							foreach($country_sql as $country_data)
							{
								$select='';
								if($country==$country_data['city_country'])
									$select='selected="selected"';
								?>
							<option <?=$select;?> value="<?=$country_data['city_country'];?>" ><?=$country_data['city_country']; ?></option>	
								<?php
							}
							
                           ?> 
								</select>
									
                                    
                                </div>
                            </div>
							
                            <div class="form-group"><label class="col-md-4 control-label" for="state">State/Region</label>

                                <div class="col-lg-8">
								<select name="state" class="form-control" id="state" onchange="get_city(this.value)" >
								<option value="">Select State</option>
						
						<?php $state_sql = sqlfetch("select DISTINCT city_state from `cities` where city_country LIKE '$country' order by city_state"); 
						if(count($state_sql))
							foreach($state_sql as $state_data)
							{
								$select='';
								if($state==$state_data['city_state'])
									$select='selected="selected"';
								?>
							<option <?=$select;?> value="<?=$state_data['city_state'];?>" ><?=$state_data['city_state']; ?></option>	
								<?php
							}
							
                           ?> 
						   </select>
								
								
                                </div>
                            </div>
                            <div class="form-group"><label class="col-md-4 control-label" for="city">City</label>

                                <div class="col-lg-8">
								<select name="city" class="form-control" id="city" >
								<option value="">Select city</option>
						
						<?php $city_sql = sqlfetch("select city_name from `cities` where city_state LIKE '$state' order by city_name"); 
						if(count($city_sql))
							foreach($city_sql as $city_data)
							{
								$select='';
								if($city==$city_data['city_name'])
									$select='selected="selected"';
								?>
							<option <?=$select;?> value="<?=$city_data['city_name'];?>" ><?=$city_data['city_name']; ?></option>	
								<?php
							}
                           ?> 
						   </select>
                                </div>
                            </div>
							
							<div class="form-group"><label class="col-md-4 control-label" for="city">Nature of Business</label>

                                <div class="col-lg-8">
									<textarea name="nature_of_business" class="form-control"><?=$nature_of_business;?></textarea>
								</div>
							</div>
							
							
							
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-offset-2 col-lg-10">

                                    <button name="<?=$formname; ?>" class="btn btn-primary waves-effect waves-light" type="submit" id="submit"><i class="fa fa-check"></i> Save</button> | <a href="<?=SITE_URL;?>view_customer.php">Or Cancel</a>
                                </div>
                            </div>
							<?php
								global $get_admin_access_arr;
							if((in_array('59',$get_admin_access_arr))){ ?>
							<div class="form-group">
                                <div class="col-md-offset-2 col-lg-10">

                                    <button name="verify_this" class="btn btn-success waves-effect waves-light" type="submit" id="submit"><i class="fa fa-check-circle"></i> Verify</button> |

									<button name="unverify_this" class="btn btn-danger waves-effect waves-light" type="submit" id="submit"><i class="fa fa-archive"></i>Disapprove</button>
                                </div>
                            </div>
							<?php 
							} ?>
                        </div>
                    </div>


                </form>
            
	
<?php 
}

?>
<?php include('include/header.php'); ?>


<body class="nav-md">
<script>
function getAjaxVariable()
 {
	 var xmlhttp;
	if(window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	  return xmlhttp;
 }
 
 function get_states(country){
var xmlhttp=getAjaxVariable();
 xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("state").innerHTML=xmlhttp.responseText;
      document.getElementById("state").style.border="1px solid #A5ACB2";
    }
  }

  // var query1=document.getElementById('query1').value;

  xmlhttp.open("GET","function/ajax_city.php?country="+country+"&q=state&searchajax=1",true);
  xmlhttp.send();
 }
 
 function get_city(state){
var xmlhttp=getAjaxVariable();
 xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("city").innerHTML=xmlhttp.responseText;
      document.getElementById("city").style.border="1px solid #A5ACB2";
    }
  }

  // var query1=document.getElementById('query1').value;

  xmlhttp.open("GET","function/ajax_city.php?state="+state+"&q=city&searchajax=1",true);

  xmlhttp.send();
 }
 
 </script>

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
                <h5>Edit Client</h5>
            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>
			<?php 
			$pid=$_GET['pid'];
			$customer_data=sqlfetch("SELECT * FROM `customer` where id='$pid' ");
			foreach($customer_data as $customer)
			{
				extract($customer);
                category_form($pid,$name,$c_name,$email,$phone,$addr,$country,$c_group,$password,$city,$state,$zip,$nature_of_business,$formname='editdone');
				
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
                <h5>Add Contact</h5>

                

            </div>
            <div class="ibox-content" id="ibox_form">
                <?=$umessage;?>

                <?php category_form();?>
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