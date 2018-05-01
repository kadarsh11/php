<?php
include("./function.php");
if($_GET['snooze_it'])
{

	extract($_GET);
	
		$snooze_arr=$_GET;
		$snooze_time=$snooze_time+1;
		$affected_rows=insert('snooze',$snooze_arr);
		if(count($affected_rows))
		{ 
			echo 'ok';
			exit();
		}
		else
		{
			?>
			cannot save
			<?
		}
	
}