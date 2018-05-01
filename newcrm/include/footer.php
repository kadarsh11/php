		<footer>
          <div class="pull-right">
            Powered by <a href="<?=COPYRIGHT_LINK; ?>"><?=COPYRIGHT_NAME; ?></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

<?php 
if((get_admin_role_id(get_admin_id())==2) and !(isset($m_on_call)))	
{ ?>

<?php 
	// Active Session ID
	$admin_id=get_admin_id();
	// Actual Popups Array
	$call_data_arr=array();
	// TOday's Date for Comparision
	$today_date=date('Y-m-d');
	//SQL Query to Select all clients which are scheduled to call today 
	$today_call_arr=sqlfetch("SELECT DISTINCT cid FROM `sales_data_assign` where assign_to='$admin_id' and next_follow LIKE '$today_date%' and !(status='1')");
	if(count($today_call_arr))
	{
		foreach($today_call_arr as $today_call_data)
		{
			$temp_cid=0;
			$temp_cid=$today_call_data['cid'];
			// if last call was made by the same person it will popup here only
			 
			$popup_data_pop_up_list=sqlfetch("SELECT * FROM erp_chat where cid='$temp_cid' order by id desc limit 1");
			if(count($popup_data_pop_up_list))
			{
				foreach($popup_data_pop_up_list as $popup_data_pop_up_list_data)
				{
					if($popup_data_pop_up_list_data['sales_id']==$admin_id)
					$call_data_arr[]=$popup_data_pop_up_list_data;
				}
			}
		}
		
		 count($call_data_arr);
		 
		if(count($call_data_arr))
		{
			foreach($call_data_arr as $call_pop)
			{
				$time_in_milisec=0;	 
				$snooze_times=0;
				$call_temp_id=$call_pop['id'];
				$datenow=date('Y-m-d H:i:s');
				$datetime1 = new DateTime($call_pop['nextdate']);
				$datetime2 = new DateTime($datenow);
				
				$snooze_sql=sqlfetch("SELECT * FROM snooze where erp_chat_id='$call_temp_id'");
				if(count($snooze_sql))
				{
					$snooze_times=count($snooze_sql);
					foreach($snooze_sql as $snooze_data)
					{
						$time_in_milisec=$time_in_milisec+($snooze_data['snooze_for']*60);
					}
				}
						

				if($datetime1>$datetime2)
				{
					$interval = $datetime1->diff($datetime2);
					 $interval;
					$hours   = $interval->format('%h');
					$minutes = $interval->format('%i');
					$seconds = $interval->format('%s');

					$hrs_in_sec=$hours*60*60;
					$min_in_sec=$minutes*60;

					// echo $seconds;

					$total_seconds=$hrs_in_sec+$min_in_sec+$seconds;
					$time_in_milisec=$time_in_milisec+$total_seconds*1000;
				}
				else
				{
					$time_in_milisec=0;
				}
?>
<script type="text/javascript">
setTimeout( function(){
    $(document).ready(function(){
        $(".my_modal<?=$call_pop['id'];?>").modal('show');
    });
	},<?=$time_in_milisec;?>);
</script>
		  <div data-backdrop="static" data-keyboard="false" class="modal fade my_modal<?=$call_pop['id'];?> bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md">
			  <div class="modal-content">

				<div class="modal-header">
				  <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				  </button>-->
				  <h4 class="modal-title" id="myModalLabel2">Scheduled Call Reminder</h4>
				</div>
				<div class="modal-body">
				  <h4></h4>
				  <table class="table table-responsive table-stripped">
					<tr>
						<td>Last Conversation</td>
						<td>Date</td>
						<td>Client Name</td>
						<td>Snoozed For</td>
					</tr>
					<tr>
						<td><?=$call_pop['remarks'];?></td>
						<td><?=$call_pop['tdate'];?></td>
						<td><?=get_customer_name($call_pop['cid']);?></td>
						<td><?=$snooze_times;?></td>
					</tr>
				  </table>
				</div>
				<div class="modal-footer">
				  <button type="button" onclick=" snooze_it(<?=$call_pop['id'];?>,<?=$snooze_times;?>,5,<?=$call_pop['cid'];?>,'.my_modal<?=$call_pop['id'];?>')" class="btn btn-default" >5 Min</button>
				  <button type="button" onclick=" snooze_it(<?=$call_pop['id'];?>,<?=$snooze_times;?>,10,<?=$call_pop['cid'];?>,'.my_modal<?=$call_pop['id'];?>')" class="btn btn-default" >10 Min</button>
				  <button type="button" onclick=" snooze_it(<?=$call_pop['id'];?>,<?=$snooze_times;?>,15,<?=$call_pop['cid'];?>,'.my_modal<?=$call_pop['id'];?>')" class="btn btn-default" >15 Min</button>
				  <button type="button"  onclick=" snooze_it(<?=$call_pop['id'];?>,<?=$snooze_times;?>,20,<?=$call_pop['cid'];?>,'.my_modal<?=$call_pop['id'];?>')" class="btn btn-default" >20 Min</button>
				  <a href="saleoncall.php?cid=<?=$call_pop['cid'];?>"><button type="button"  class="btn btn-primary">Start Call</button></a>
				</div>

			  </div>
			</div>
		  </div>
	<?php 
	
			}
		}
	}
}
?>
	

	
    <!-- jQuery 
    <script src="<?=SITE_URL;?>vendors/jquery/dist/jquery.min.js"></script>-->
	<script> <?php readfile('vendors/jquery/dist/jquery.min.js'); ?> </script>
    <!-- Bootstrap 
    <script src="<?=SITE_URL;?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>-->
	<script> <?php readfile('vendors/bootstrap/dist/js/bootstrap.min.js'); ?> </script>
    <!-- FastClick 
    <script src="<?=SITE_URL;?>vendors/fastclick/lib/fastclick.js"></script>-->
	<script> <?php readfile('vendors/fastclick/lib/fastclick.js'); ?> </script>
    <!-- NProgress 
    <script src="<?=SITE_URL;?>vendors/nprogress/nprogress.js"></script>-->
	<script> <?php readfile('vendors/nprogress/nprogress.js'); ?> </script>
    <!-- Chart.js 
    <script src="<?=SITE_URL;?>vendors/Chart.js/dist/Chart.min.js"></script>-->
	<script> <?php readfile('vendors/Chart.js/dist/Chart.min.js'); ?> </script>
    <!-- gauge.js 
    <script src="<?=SITE_URL;?>vendors/gauge.js/dist/gauge.min.js"></script>-->
	<script> <?php readfile('vendors/gauge.js/dist/gauge.min.js'); ?> </script>
    <!-- bootstrap-progressbar 
    <script src="<?=SITE_URL;?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>-->
	<script> <?php readfile('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?> </script>
    <!-- iCheck 
    <script src="<?=SITE_URL;?>vendors/iCheck/icheck.min.js"></script>-->
	<script> <?php readfile('vendors/iCheck/icheck.min.js'); ?> </script>
    <!-- Skycons 
    <script src="<?=SITE_URL;?>vendors/skycons/skycons.js"></script>-->
	<script> <?php readfile('vendors/skycons/skycons.js'); ?> </script>
    <!-- Flot 
    <script src="<?=SITE_URL;?>vendors/Flot/jquery.flot.js"></script>-->
	<script> <?php readfile('vendors/Flot/jquery.flot.js'); ?> </script>
    <!--
	<script src="<?=SITE_URL;?>vendors/Flot/jquery.flot.pie.js"></script>-->
	<script> <?php readfile('vendors/Flot/jquery.flot.pie.js'); ?> </script>
    <!--
	<script src="<?=SITE_URL;?>vendors/Flot/jquery.flot.time.js"></script>-->
	<script> <?php readfile('vendors/Flot/jquery.flot.time.js'); ?> </script>
    <!--
    <script src="<?=SITE_URL;?>vendors/Flot/jquery.flot.stack.js"></script>-->
	<script> <?php readfile('vendors/Flot/jquery.flot.stack.js'); ?> </script>
    <!--
    <script src="<?=SITE_URL;?>vendors/Flot/jquery.flot.resize.js"></script>-->
	<script> <?php readfile('vendors/Flot/jquery.flot.resize.js'); ?> </script>
    <!-- Flot plugins 
    <script src="<?=SITE_URL;?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>-->
	<script> <?php readfile('vendors/flot.orderbars/js/jquery.flot.orderBars.js'); ?> </script>
    <!--
	<script src="<?=SITE_URL;?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>-->
	<script> <?php readfile('vendors/flot-spline/js/jquery.flot.spline.min.js'); ?> </script>
    <!--
    <script src="<?=SITE_URL;?>vendors/flot.curvedlines/curvedLines.js"></script>-->
	<script> <?php readfile('vendors/flot.curvedlines/curvedLines.js'); ?> </script>
    <!-- DateJS 
    <script src="<?=SITE_URL;?>vendors/DateJS/build/date.js"></script>-->
	<script> <?php readfile('vendors/DateJS/build/date.js'); ?> </script>
    <!-- JQVMap 
    <script src="<?=SITE_URL;?>vendors/jqvmap/dist/jquery.vmap.js"></script>-->
	<script> <?php readfile('vendors/jqvmap/dist/jquery.vmap.js'); ?> </script>
    <!--
	<script src="<?=SITE_URL;?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>-->
	<script> <?php readfile('vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?> </script>
    <!--
    <script src="<?=SITE_URL;?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>-->
	<script> <?php readfile('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?> </script>
    <!-- bootstrap-daterangepicker 
    <script src="<?=SITE_URL;?>vendors/moment/min/moment.min.js"></script>-->
	<script> <?php readfile('vendors/moment/min/moment.min.js'); ?> </script>
    <!--
    <script src="<?=SITE_URL;?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>-->
	<script> <?php readfile('vendors/bootstrap-daterangepicker/daterangepicker.js'); ?> </script>

    <!-- Custom Theme Scripts 
    <script src="<?=SITE_URL;?>build/js/custom.min.js"></script>-->
	<script> <?php readfile('build/js/custom.min.js'); ?> </script>
	
    
								<script src="<?=SITE_URL;?>js/ckeditor/ckeditor.js"></script>

<script>


$(document).ready(function() {
	$("textarea").each(function(){
		CKEDITOR.replace( this );
	});
});



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
 
 
	function snooze_it(erp_chat_id,snooze_time,snooze_for,cid,class_name)
	{
		
		var xmlhttp=getAjaxVariable();
		
		xmlhttp.onreadystatechange=function() 
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200) 
			{
				var x = xmlhttp.responseText.trim();  
				if(x=="ok")
				{
					$(function () {
					   $(class_name).modal('toggle');
					});
					// $().modal('toggle');
				  return true;
				}
				else
				{
				  return false;
				}
				return false;
			}
				return false;
		}
			
		xmlhttp.open("GET","<?=SITE_URL;?>function/snooze_insert.php?erp_chat_id="+erp_chat_id+"&snooze_time="+snooze_time+"&snooze_for="+snooze_for+"&cid="+cid+"&snooze_it=1",true);
		xmlhttp.send();
				
	}

</script>