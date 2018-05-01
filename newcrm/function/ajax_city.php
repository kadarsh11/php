<?php
include("./function.php");
if($_GET['searchajax'])
{

	extract($_GET);
	if($q=='state')
	{
		?>
		
<option value="">Select State</option>		
		<?php
		$state_sql = sqlfetch("select DISTINCT city_state from `cities` where city_country LIKE '$country' order by city_state"); 
						if(count($state_sql))
							foreach($state_sql as $state_data)
							{
								
								?>
							<option  value="<?=$state_data['city_state'];?>" ><?=$state_data['city_state']; ?></option>	
								<?php
							}
	}
	elseif($q=='city')
	{
		?>
<option value="">Select City</option>		
<?php
		$city_sql = sqlfetch("select city_name from `cities` where city_state LIKE '$state' order by city_name"); 
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
	}
	
}
?>