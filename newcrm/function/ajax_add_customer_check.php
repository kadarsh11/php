<?php
include("./function.php");
if($_GET['searchajax'])
{

	extract($_GET);
	if($q=='company_name')
	{
		if($c_name=='')
		{echo '<i class="fa fa-exclamation"></i> this is required Field';exit;}
		$company_name_sql = sqlfetch("select * from `customer` where c_name LIKE '$c_name'"); 
						if(count($company_name_sql))
						{ ?>
							<i class="fa fa-exclamation"></i> This Name Already Exists
							<?php
							exit();
						}
						else
						{
							?>
							<i class="fa fa-check"></i> This Name is Available
							<?
						}
	}
	elseif($q=='email')
	{
		if($email=='')
		{echo '<i class="fa fa-exclamation"></i> this is required Field';exit;}
		$company_name_sql = sqlfetch("select * from `customer` where email LIKE '$email'"); 
						if(count($company_name_sql))
						{ ?>
							<i class="fa fa-exclamation"></i> This Email- ID Already Exists
							<?php
							exit();
						}
						else
						{
							?>
							<i class="fa fa-check"></i> This Email-ID is Available
							<?
						}
	}
	elseif($q=='phone')
	{
		if($phone=='')
		{echo '<i class="fa fa-exclamation"></i> this is required Field';exit;}
		$company_name_sql = sqlfetch("select * from `customer` where phone LIKE '%$phone%'"); 
						if(count($company_name_sql))
						{ ?>
							<i class="fa fa-exclamation"></i> This Phone No Already Exists
							<?php
							exit();
						}
						else
						{
							?>
							<i class="fa fa-check"></i> This Phone No is Available
							<?
						}
	}
	
}