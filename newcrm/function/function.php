<?php
// error_reporting(0);
define('SITE_TITLE','Soft Info CRM + ERP');
// define('SITE_URL','http://192.168.1.3/newcrm/');
// define('SITE_URL','http://192.168.0.104/newcrm/');
define('SITE_URL','http://localhost/newcrm/');
define('COPYRIGHT_LINK','http://www.softinfotechnology.com');
define('COPYRIGHT_NAME','SIT');
$siteTitle='Admin Panel';
date_default_timezone_set('Asia/Kolkata');
session_start();
function getPDOObject() {
$dsn = 'mysql:host=localhost;dbname=newcrm;charset=utf8mb4';
$user = 'root';
$pass = '';
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
   return $pdo;
   
   }


function numbertofloat($num){
	return number_format((float)$num, 2, '.', '');
}

function validate_user($mem_id)
{
	$haveaccess=false;
	$group_id=get_group_id($mem_id);
	
	if($haveaccess)
	{
		return true;
	}
	else
	{
		header('location:dont_have_permit.php');
		return false;
		exit;
	}
}
   
function sqlfetch($query)
{
	$row=array();
	$pdo=getPDOObject();
	$sql=$pdo->query($query);
	
	$datas = $sql->fetchAll(PDO::FETCH_ASSOC);
	foreach($datas as $data)
	$row[]=$data;
	return $row;
}

function get_admin_access_arr($mem_id)
{
	$admin_role=0;
	$privilege_arr=array();
	$data=sqlfetch("SELECT * FROM admin where id='$mem_id'");
	if(count($data))
		foreach($data as $admin)
		{
			$admin_role=$admin['admin_role_id'];
		}
	$role_data=sqlfetch("SELECT * FROM admin_roles where id='$admin_role' ");
	if(count($role_data))
		foreach($role_data as $role)
		$privilege_arr=explode(',',$role['privilege']);
		return $privilege_arr;
}

function get_auto_increment($table)
{
	$next_number='NA';
	$sql=sqlfetch("SHOW TABLE STATUS LIKE '$table'");
	if(count($sql))
		foreach($sql as $result)
		{
			$next_number=$result['Auto_increment'];
		}
	return $next_number;
}


function is_admin_access($table_name,$access_key)
{
	// Temp/Default Values
	$access_code=0;
	$access_stat=false;
	
	$access_arr=get_admin_access_arr(get_admin_id());
	$data=sqlfetch("SELECT * FROM `access_db` where tbl_name LIKE '$table_name' ");
	if(count($data))
		foreach($data as $access_data)
		$access_code=$access_data[$access_key];
	
	if(in_array($access_code,$access_arr))
		$access_stat=true;
	
	return $access_stat;
}

/*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, order_by, limit and return_type conditions
     */
function getRows($table,$conditions = array()){
	
	$access_stat_by_admin_given=is_admin_access($table,'viewing');
	if(!$access_stat_by_admin_given)
	{
		header('location:'.SITE_URL.'page_403.php');
		exit;
	}
	
	$pdo=getPDOObject();
	$sql = 'SELECT ';
	$sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
	$sql .= ' FROM '.$table;
	if(array_key_exists("where",$conditions) and (count($conditions['where'])) ){
		$sql .= ' WHERE ';
		$i = 0;
		foreach($conditions['where'] as $key => $value){
			$pre = ($i > 0)?' AND ':'';
			$sql .= $pre.$key." = '".$value."'";
			$i++;
		}
	}
	if(array_key_exists("like",$conditions)){
		if((array_key_exists("where",$conditions)) and count($conditions['where']))
		{
			
		}
		else {
		$i = 0;
		$sql .= ' WHERE ';
		}
		foreach($conditions['like'] as $like){
			// echo 'Yes';
			$pre = ($i > 0)?' AND ':'';
			$sql .= $pre.$like;
			$i++;
		}
	}
	
	if(array_key_exists("order_by",$conditions)){
		$sql .= ' ORDER BY '.$conditions['order_by']; 
	}
	
	if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
		$sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
	}elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
		$sql .= ' LIMIT '.$conditions['limit']; 
	}
	// echo $sql;
	$query = $pdo->prepare($sql);
	$query->execute();
	
	if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
		switch($conditions['return_type']){
			case 'count':
				$data = $query->rowCount();
				break;
			case 'single':
				$data = $query->fetch(PDO::FETCH_ASSOC);
				break;
			default:
				$data = '';
		}
	}else{
		if($query->rowCount() > 0){
			$data = $query->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	return !empty($data)?$data:array();
}

/*
 * Insert data into the database
 * @param string name of the table
 * @param array the data for inserting into the table
 */
function insert($table,$data){
	
	$access_stat_by_admin_given=is_admin_access($table,'adding',$bypass=false);
	
	if(!($access_stat_by_admin_given) and ($bypass))
	{
		header('location:'.SITE_URL.'page_403.php');
		exit();
	}
	$pdo=getPDOObject();
	
	// $fld_str='';$val_str='';
	// if($table_name && is_array($data_array))
		// {
	  $sql="SHOW COLUMNS FROM `".$table."`";
		$columns_query= sqlfetch($sql);
		
				foreach($columns_query as $coloumn_data)  
			  $column_name[]=$coloumn_data['Field'];
				// print_r($column_name);  
	
	if(!empty($data) && is_array($data)){
		$columns = '';
		$values  = '';
		$i = 0;
		if(!array_key_exists('created',$data)){
			$data['created'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists('modified',$data)){
			$data['modified'] = date("Y-m-d H:i:s");
		}

		$actual_data=array();
		
		foreach($data as $key=>$val)
			{
			 if(in_array($key,$column_name))
				{
					// echo $key;
					$actual_data[$key]=$val;
				}
			}
		// print_r($actual_data);
		$columnString = implode(',', array_keys($actual_data));
		$valueString = ":".implode(',:', array_keys($actual_data));
		$sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
		$query = $pdo->prepare($sql);
		foreach($actual_data as $key=>$val){
			$val = htmlspecialchars(strip_tags($val));
			$query->bindValue(":".$key, $val);
		}
		$insert = $query->execute();
		if($insert){
			$data['id'] = $pdo->lastInsertId();
			return $data;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

/*
 * Update data into the database
 * @param string name of the table
 * @param array the data for updating into the table
 * @param array where condition on updating data
 */
function update($table,$data,$conditions){
	
	$access_stat_by_admin_given=is_admin_access($table,'updating');
	if(!$access_stat_by_admin_given)
	{
		header('location:'.SITE_URL.'page_403.php');
		exit;
	}
	
	$sql="SHOW COLUMNS FROM `".$table."`";
		$columns_query= sqlfetch($sql);
		
				foreach($columns_query as $coloumn_data)  
			  $column_name[]=$coloumn_data['Field'];
	$actual_data=array();
		
		foreach($data as $key=>$val)
			{
			 if((in_array($key,$column_name)) )
				{
					// echo $key;
					$actual_data[$key]=addslashes($val);
				}
			}
	$pdo=getPDOObject();
	
	
	if(!empty($actual_data) && is_array($actual_data)){
		$colvalSet = '';
		$whereSql = '';
		$i = 0;
		// if(!array_key_exists('modified',$data)){
			// $actual_data['modified'] = date("Y-m-d H:i:s");
		// }
		foreach($actual_data as $key=>$val){
			$pre = ($i > 0)?', ':'';
			$val = ($val);
			$colvalSet .= $pre.$key."='".$val."'";
			$i++;
		}
		if(!empty($conditions)&& is_array($conditions)){
			$whereSql .= ' WHERE ';
			$i = 0;
			foreach($conditions as $key => $value){
				$pre = ($i > 0)?' AND ':'';
				$whereSql .= $pre.$key." = '".$value."'";
				$i++;
			}
		}
		$sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
		$query = $pdo->prepare($sql);
		$update = $query->execute();
		return $update?$query->rowCount():false;
	}else{
		return false;
	}
}

/*
 * Delete data from the database
 * @param string name of the table
 * @param array where condition on deleting data
 */
function del($table,$conditions){
	$access_stat_by_admin_given=is_admin_access($table,'deleting');
	if(!$access_stat_by_admin_given)
	{
		header('location:'.SITE_URL.'page_403.php');
		exit;
	}
	$pdo=getPDOObject();
	$whereSql = '';
	if(!empty($conditions)&& is_array($conditions)){
		$whereSql .= ' WHERE ';
		$i = 0;
		foreach($conditions as $key => $value){
			$pre = ($i > 0)?' AND ':'';
			$whereSql .= $pre.$key." = '".$value."'";
			$i++;
		}
	}
	$sql = "DELETE FROM ".$table.$whereSql;
	$delete = $pdo->exec($sql);
	return $delete?$delete:false;
}

function del_str($table,$conditions_str=''){
	$access_stat_by_admin_given=is_admin_access($table,'deleting');
	if(!$access_stat_by_admin_given)
	{
		header('location:'.SITE_URL.'page_403.php');
		exit;
	}
	
	$pdo=getPDOObject();
	$whereSql = '';
	if($conditions!=''){
		$whereSql .= ' WHERE ';
		foreach($conditions as $key => $value){
			$pre = ($i > 0)?' AND ':'';
			$whereSql .= $pre.$key." = '".$value."'";
			$i++;
		}
	}
	$sql = "DELETE FROM ".$table.$whereSql;
	$delete = $pdo->exec($sql);
	return $delete?$delete:false;
}

function get_active_status_text($num)
{
	$status='';
	if($num==0)
		$status='<span class="label label-default">Deactive</span>';
	if($num==1)
		$status='<span class="label label-success">Active</span>';
	return $status;
}

function get_verify_status_text($num)
{
	$status='';
	if($num==0)
		$status='<span class="label label-default">UnChecked</span>';
	if($num==1)
		$status='<span class="label label-success">Verified</span>';
	if($num==2)
		$status='<span class="label label-danger">Denied</span>';
	return $status;
}

function check_session()
{
	if(!isset($_SESSION['admin_id']))
	{
		header('location:alogin.php');
	}
}

function check_login()
{
	if(isset($_SESSION['admin_id']))
	{
		header('location:./index.php');
	}
}

function login_me()
{	

	$pdo=getPDOObject();
	if(($_POST['email']=='') || ($_POST['pass']==''))
		$message='
	<div class="alert alert-danger">
		Please enter Username and Password
	</div>';
	else
	{
		$user=md5($_POST['email']);
		$pass=md5($_POST['pass']);
			
$stmt = $pdo->prepare("SELECT * FROM admin where md5(email)=? and md5(password)=? and actstat='1' order by id limit 1");
$stmt->execute(array($user,$pass));
$num=$stmt->rowCount();
	
		if($num>0)
		{
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($row as $admin)
			{
				$date=date('y-m-d h:i:s');
			$stmt = $pdo->prepare("UPDATE admin SET last_login=? where md5(email)=? and md5(password)=? ");
			$stmt->execute(array($date,$user,$pass));
			insert('attendance',array('admin_id'=>$admin['id']),true);
			
			@session_start();
			$_SESSION['admin_id']=$admin['id'];
			// $_SESSION['admin_access']=get_admin_access_arr($admin['id']);
			
			$message='<div class="alert alert-success">Login Successful ,Please Refresh page if not redirected.</div>';
			header('location:./index.php');
			}	
		}
		else
		{
			$message='
			<div class="alert alert-danger">
			Invalid Credentials, Please check Your Username and Password
			</div>';
		}
	}
	return $message;
}

function get_new_member_count()
{
	$pdo=getPDOObject();
	$sql=$pdo->query("SELECT * from seller where actstat='0'");
	$num=$sql->rowCount();
	return $num;
}

function get_admin_id()
{
	@$mid=$_SESSION['admin_id'];
	return $mid;
}

function get_admin_name()
{
	$mid=md5($_SESSION['admin_id']);
	$sql=sqlfetch("SELECT * FROM admin where md5(id)='$mid'");
	if(count($sql))
		foreach($sql as $admin_data)
	$name=$admin_data['fname'].' '.$admin_data['lname'];
	return $name;
}

function get_admin_name_by_id($mid)
{
	$sql=sqlfetch("SELECT * FROM admin where id='$mid'");
	if(count($sql))
		foreach($sql as $admin_data)
	$name=$admin_data['fname'].' '.$admin_data['lname'];
	return $name;
}

function get_admin_email($mid)
{
	$sql=sqlfetch("SELECT * FROM admin where id='$mid'");
	if(count($sql))
		foreach($sql as $admin_data)
	$email=$admin_data['email'];
	return $email;
}

function get_admin_data($id)
{
	$sql=sqlfetch("SELECT * FROM admin where id='$id'");
	if(count($sql))
		foreach($sql as $admin_data)
		return $admin_data;
}

function get_admin_photo_by_admin_id($id)
{
	$photo='';
	$admin_data=get_admin_data($id);
	$photo_exists=false;
	$photo_url='';
	if($admin_data['photo']!='')
	{
	$photo_url='upload/'.$admin_data['photo'];
	$photo_exists=file_exists($photo_url);
	}
	return $photo_exists ? $photo_url : 'images/user.png';
}

function get_admin_role_text_by_admin_id($id)
{
	$name='';
	$admin_data=get_admin_data($id);
	$admin_role_id=$admin_data['admin_role_id'];
	$sql=sqlfetch("SELECT * FROM admin_roles where id='$admin_role_id'");
	if(count($sql))
		foreach($sql as $admin_role_data)
	$name=$admin_role_data['name'];
	return $name ? $name : 'NA';
}

function get_admin_role_id($id)
{
	// $name='';
	$admin_data=get_admin_data($id);
	return $admin_role_id=$admin_data['admin_role_id'];
	// return $name ? $name : 'NA';
}

function get_customer_next_follow_date($id)
{
	$sql=sqlfetch("SELECT nextdate from erp_chat where cid='$id' order by id desc limit 1");
	if(count($sql))
		foreach($sql as $chat_data)
		{
			$nextdate=$chat_data['nextdate'];
		}
	return $nextdate ? $nextdate : 'NA';
}

function get_customer_name($mid)
{
	$name='NA';
	$mid=md5($mid);
	$sql=sqlfetch("SELECT * FROM customer where md5(id)='$mid'");
	if(count($sql))
		foreach($sql as $admin_data)
	$name=$admin_data['c_name'];
	return $name;
}

function get_customer_category($id)
{
	$name='';
	$sql=sqlfetch("SELECT * FROM tbl_customer_category where id='$id'");
	if(count($sql))
		foreach($sql as $customer_data)
	$name=$customer_data['category_name'];
	return $name ? $name : 'NA';
}

function get_category_name($id)
{
	
	$name='';
	$sql=sqlfetch("SELECT * FROM category where id='$id'");
	if(count($sql))
		foreach($sql as $category)
	$name=$category['name'];
	return $name;
}

function get_product_name($id)
{
	$name='';
	$sql=sqlfetch("SELECT * FROM product where id='$id'");
	if(count($sql))
		foreach($sql as $product)
	$name=$product['name'];
	return $name;
}

function get_category_count()
{
	$count=0;
	$data=sqlfetch("SELECT id from category");
	$count=count($data);
	return $count;
}

function get_product_count()
{
	$count=0;
	$data=sqlfetch("SELECT id from product");
	$count=count($data);
	return $count;
}

function get_category_id($name)
{
	
	$id=0;
	$sql=sqlfetch("SELECT * FROM category where name='$name' order by fld_order limit 1");
	if(count($sql))
		foreach($sql as $category)
			$id=$category['id'];
	return $id;
}

function get_product_id($name)
{
	
	$id=0;
	$sql=sqlfetch("SELECT * FROM product where name='$name' order by fld_order limit 1");
	if(count($sql))
		foreach($sql as $product)
			$id=$product['id'];
	return $id;
}

function get_first_prod_by_cat($id)
{
	$data=sqlfetch("SELECT * FROM product where subcat='$id' order by id limit 1");
	foreach($data as $product)
	$pid=$product['id'];
	return $pid;
}

function total_data_erp($mem_id)
{
	$final_data=array();
	$data=sqlfetch("SELECT DISTINCT `cid` FROM `sales_data_assign` where assign_to='$mem_id'");
	// echo count($data);
	if(count($data))
		foreach($data as $temp_data)
		{
			$temp_cid=$temp_data['cid'];
			$final_data_sql=sqlfetch("SELECT * FROM `customer` where id='$temp_cid' and verify_stat='1'");
			if(count($final_data_sql))
			{
				$temp_cid;
				$final_data[]=$temp_cid;
			}
		}
	return $final_data;
}

function get_erp_status($cid)
{
	$status=false;
	$data=sqlfetch("SELECT * FROM sales_data_assign where cid='$cid' order by id desc limit 1");
	if(count($data))
		foreach($data as $temp_data)
		{
			$status=$temp_data['status'];
		}
	return $status;
}

function total_data_erp_left($mem_id)
{
	$final_data=array();
	$data=sqlfetch("SELECT id,cid FROM sales_data_assign where assign_to='$mem_id' and !(status in (1,5))");
	$count=count($data);
	if(count($data))
		foreach($data as $temp_data)
		{
			$temp_cid=$temp_data['cid'];
			$final_data_sql=sqlfetch("SELECT * FROM `customer` where id='$temp_cid' and verify_stat='1'");
			if(count($final_data_sql))
			{
				$temp_cid;
				$final_data[]=$temp_cid;
			}
		}
	return $count=count($final_data);
}

function total_data_erp_mature($mem_id)
{
	$data2=sqlfetch("SELECT id from erp_chat where sales_id='$mem_id' and status='1'");
	return $count2=count($data2);
}

function calculate_my_target($mem_id)
{
	$total=0;
	$data=sqlfetch("SELECT * FROM admin where uplead_id='$mem_id' and admin_role_id='2'");
	if(count($data))
		foreach($data as $down_line)
			$total=calculate_my_target($down_line['id']);
	
	$my_own_target_data=sqlfetch("SELECT * from sale_target where sales_id='$mem_id'");
		foreach($my_own_target_data as $mytarget)
			$total=$total+$mytarget['target'];
	return $total;
}

function calculate_individual_target($mem_id)
{
	$total=0;
	$my_own_target_data=sqlfetch("SELECT * from sale_target where sales_id='$mem_id'");
		foreach($my_own_target_data as $mytarget)
			$total=$total+$mytarget['target'];
	return $total;
}

function calculate_individual_target_data($mem_id)
{
	$total=0;
	$my_own_target_data=sqlfetch("SELECT * from data_target where data_operator_id='$mem_id'");
		foreach($my_own_target_data as $mytarget)
			$total=$total+$mytarget['target'];
	return $total;
}

function calculate_individual_target_done($mem_id)
{
	$total=0;
	$day_today=date('d');
	// if($day_today>=21)
	// {
		// $datetime1 = date('y-m-21 00:00:00');
	// }
	// else
	// {
		// $datetime1 = date('y-m-21 00:00:00');
		// $datetime1= date('y-m-21 00:00:00',strtotime('-1 month',strtotime($datetime1)));
	// }
		// $datetime2 = date('y-m-21 00:00:00');		
	$dates=get_current_month_dates();
	$datetime1=$dates['date1'];
	$datetime2=$dates['date2'];
	
	$sale_done_data=sqlfetch("SELECT * FROM sale_done where sales_id='$mem_id' and actstat='1' and (dated between '$datetime1' and '$datetime2' )");
	foreach($sale_done_data as $sale_done)
	{
		$total=$total+$sale_done['price'];
	}
	return $total;
}

function calculate_individual_incentive($mem_id)
{
	$total=0;
	$day_today=date('d');
	// if($day_today>=21)
	// {
		// $datetime1 = date('y-m-21 00:00:00');
	// }
	// else
	// {
		// $datetime1 = date('y-m-21 00:00:00');
		// $datetime1= date('y-m-21 00:00:00',strtotime('-1 month',strtotime($datetime1)));
	// }
		// $datetime2 = date('y-m-21 00:00:00');		
	$dates=get_current_month_dates();
	$datetime1=$dates['date1'];
	$datetime2=$dates['date2'];
	
	$incentive_data=sqlfetch("SELECT * FROM incentive where admin_id='$mem_id' and (dated between '$datetime1' and '$datetime2' )");
	foreach($incentive_data as $incentive)
	{
		$total=$total+$incentive['amt'];
	}
	return $total;
}

function get_sales_category_stat_text($id)
{
	$name='';
	$data=sqlfetch("SELECT * FROM `sales_category_type` where id='$id' ");
	if(count($data))
		foreach($data as $sale_data)
		$name=$sale_data['name'];
	
	return $name;
}

function get_sales_category_from_erp_chat($id)
{
	$stat_id='';
	$data=sqlfetch("SELECT * FROM `erp_chat` where cid='$id' order by id desc limit 1 ");
	if(count($data))
		foreach($data as $sale_data)
		$stat_id=$sale_data['status'];
	
	return $stat_id;
}

function get_package_price($id)
{
	$price=0;
	$data=sqlfetch("SELECT * FROM package where id='$id'");
	if(count($data))
		foreach($data as $price_data)
			$price=$price_data['price'];
	return $price;
}

function get_package_name($id)
{
	$name='NA';
	$data=sqlfetch("SELECT * FROM package where id='$id'");
	if(count($data))
		foreach($data as $package_data)
			$name=$package_data['name'];
	return $name;
}

function get_current_month_dates()
{
	$day_today=date('d');
	if($day_today>=21)
	{
		$datetime1 = date('y-m-21 00:00:00');
	}
	else
	{
		$datetime1 = date('y-m-21 00:00:00');
		$datetime1= date('y-m-21 00:00:00',strtotime('-1 month',strtotime($datetime1)));
	}
		$datetime2 = date('y-m-21 00:00:00');
		
	$dates[]=array();
	$dates['date1']=$datetime1;
	$dates['date2']=$datetime2;
	return $dates;
}

function get_attendance_this_month($mem_id)
{
	$dates=get_current_month_dates();
	
	 $datetime1=$dates['date1'];
	 $datetime2=$dates['date2'];
	
	// $datetime1=date('Y-m-21 00:00:00'(strtotime($datetime2)));
	// $datetime2=(strtotime($datetime2)));
	
	$no_of_attendance=0;
	$query="SELECT 	
	admin_id,COUNT( DISTINCT DATE( login_date )) AS days FROM attendance 
	WHERE  login_date BETWEEN '$datetime1' AND '$datetime2'
		and admin_id='$mem_id' ";
	$data=sqlfetch($query);
		if(count($data))
		foreach($data as $attendance)
	$no_of_attendance=$attendance['days'];
	
	return $no_of_attendance;
}

function today_matured_by_me($admin_id)
{
	$erp_arr=array();
					  $client_id_arr=array();
					  $status_id=1;
					  $today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id' and next_follow LIKE '$today_date%'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}
function total_matured_by_me($admin_id)
{
		$sale_assign_committed_arr=array();
		  $client_id_arr=array();
		  $status_id=1;
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
							else
							{
								$client_id_arr[]=$temp_cid;
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}

function today_committed_by_me($admin_id)
{
		$erp_arr=array();
					  $client_id_arr=array();
					  $status_id=2;
					  
					 $today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id' and next_follow LIKE '$today_date%'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}
function total_committed_by_me($admin_id)
{
			$sale_assign_committed_arr=array();
		  $client_id_arr=array();
		  $status_id=2;
		$today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
							else
							{
								$client_id_arr[]=$temp_cid;
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}

function today_prospective_by_me($admin_id)
{
		$erp_arr=array();
					  $client_id_arr=array();
					  $status_id=6;
					  
					 $today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id' and next_follow LIKE '$today_date%'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}
function total_prospective_by_me($admin_id)
{
			$sale_assign_committed_arr=array();
		  $client_id_arr=array();
		  $status_id=6;
		$today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
							else
							{
								$client_id_arr[]=$temp_cid;
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}

function today_followup_by_me($admin_id)
{
			$erp_arr=array();
					  $client_id_arr=array();
					  $status_id=3;
					  
					 $today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id' and next_follow LIKE '$today_date%'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}
function total_followup_by_me($admin_id)
{
	$sale_assign_committed_arr=array();
		  $client_id_arr=array();
		  $status_id=3;
		  
		 $today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
							else
							{
								$client_id_arr[]=$temp_cid;
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}

function today_data_fresh_by_me($admin_id)
{
				$erp_arr=array();
					  $client_id_arr=array();
					  $status_id=4;
					  
					$today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id' and next_follow LIKE '$today_date%'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}
function total_data_fresh_by_me($admin_id)
{
		  $client_id_arr=array();
		  // echo count($client_id_arr);
		  $status_id=4;
		 $today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id'");
					  // echo count($erp_total_data_with_my_admin_id);
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							 $temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							count($actual_erp_list);
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
							else
							{
								$client_id_arr[]=$temp_cid;
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								 $query="SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'";
					  $client_data=sqlfetch($query);
					  // var_dump($client_data);
					  return $client_data;
}

function today_data_not_interested_by_me($admin_id)
{
				$erp_arr=array();
					  $client_id_arr=array();
					  $status_id=5;
					  
					$today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id' and next_follow LIKE '$today_date%'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}
function total_data_not_interested_by_me($admin_id)
{
				
		  $sale_assign_committed_arr=array();
		  $client_id_arr=array();
		  $status_id=5;
		$today_date=date('Y-m-d');
					  $erp_total_data_with_my_admin_id=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and status='$status_id'");
					  if(count($erp_total_data_with_my_admin_id))
						  foreach($erp_total_data_with_my_admin_id as $erp_ids)
						  {
							$temp_cid=0;
							$temp_cid=$erp_ids['cid']; 
							$actual_erp_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
							if(count($actual_erp_list))
							{
								foreach($actual_erp_list as $actual_erp_list_data)
								{
									if($actual_erp_list_data['sales_id']==$admin_id)
									$client_id_arr[]=$actual_erp_list_data['cid'];
								}
							}
							else
							{
								$client_id_arr[]=$temp_cid;
							}
						  }
							
						$client_id_str=implode(',',$client_id_arr);
							if($client_id_str=='')
									$client_id_str="''";
								
					  $client_data=sqlfetch("SELECT * FROM `customer` where id in ($client_id_str) and verify_stat='1'");
					  return $client_data;
}

function total_calls_by_mem($admin_id,$today_date)
{
	$count=0;
	$sql=sqlfetch("SELECT * FROM `erp_chat` where sales_id='$admin_id' and tdate LIKE '$today_date%'");
	if(count($sql))
		$count=count($sql);
	return $count;
	
}

function today_status_calls_by_mem($admin_id,$status_id,$today_date)
{
		$count=0;
	$sql=sqlfetch("SELECT * FROM `erp_chat` where sales_id='$admin_id' and status='$status_id' and tdate LIKE '$today_date%'");
	if(count($sql))
		$count=count($sql);
	return $count;
}

 function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' AND ';
    $separator   = ', ';
    $negative    = 'NEGATIVE ';
    $decimal     = ' POINT ';
    $dictionary  = array(
        0                   => 'ZERO',
        1                   => 'ONE',
        2                   => 'TWO',
        3                   => 'THREE',
        4                   => 'FOUR',
        5                   => 'FIVE',
        6                   => 'SIX',
        7                   => 'SEVEN',
        8                   => 'EIGHT',
        9                   => 'NINE',
        10                  => 'TEN',
        11                  => 'ELEVEN',
        12                  => 'TWELVE',
        13                  => 'THIRTEEN',
        14                  => 'FOURTEEN',
        15                  => 'FIFTEEN',
        16                  => 'SIXTEEN',
        17                  => 'SEVENTEEN',
        18                  => 'EIGHTEEN',
        19                  => 'NINETEEN',
        20                  => 'TWENTY',
        30                  => 'THIRTY',
        40                  => 'FOURTY',
        50                  => 'FIFTY',
        60                  => 'SIXTY',
        70                  => 'SEVENTY',
        80                  => 'EIGHTY',
        90                  => 'NINETY',
        100                 => 'HUNDRED',
        1000                => 'THOUSAND',
        1000000             => 'MILLION',
        1000000000          => 'BILLION',
        1000000000000       => 'TRILLION',
        1000000000000000    => 'QUADRILLION',
        1000000000000000000 => 'QUINTILLION'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}



$get_admin_access_arr=get_admin_access_arr(get_admin_id());