<?php 
$date_today=date('Y-m-d');
$admin_id=get_admin_id();
$total_inserted_data=getRows('new_data_list',array('select'=>'id,cid','where'=>array('admin_id'=>get_admin_id())));
$total_inserted_count=count($total_inserted_data);
$total_inserted_data_today=sqlfetch("SELECT * FROM `new_data_list` where admin_id='$admin_id' and dated LIKE 
'$date_today%'");
$total_inserted_count_today=count($total_inserted_data_today);
$customer_id_arr_total=array();
if(count($total_inserted_data))
	foreach($total_inserted_data as $total_inserted)
		$customer_id_arr_total[]=$total_inserted['cid'];

$customer_id_str_total=implode(',',$customer_id_arr_total);
$total_verify_data=sqlfetch("SELECT * FROM customer where verify_stat='1' and id in ('$customer_id_str_total')");
$total_verify_count=count($total_verify_data);

$customer_id_arr_today=array();
if(count($total_inserted_data_today))
	foreach($total_inserted_data_today as $total_inserted_today)
		$customer_id_arr_today[]=$total_inserted_today['cid'];

$customer_id_str_today=implode(',',$customer_id_arr_today);
$today_verify_data=sqlfetch("SELECT * FROM customer where verify_stat='1' and id in ('$customer_id_str_today')");
$today_verify_count=count($today_verify_data);

$attendance_this_month=get_attendance_this_month($admin_id);
$mytarget=calculate_individual_target_data($admin_id);
?>


<!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>Total Insert Data</span>
              <div class="count"><?=$total_inserted_count;?></div>
              <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>Today Insert Data Data</span>
              <div class="count"><?=$total_inserted_count_today;?></div>
              <!--<span class="count_bottom"><i class="green">80% </i> of Total Data</span>-->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>Total Verified Data</span>
              <div class="count green"><?=$total_verify_count;?></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>-->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>Today Verified Data</span>
              <div class="count"><?=$today_verify_count;?></div>
              <!--<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Month</span>-->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-table"></i> Target</span>
              <div class="count"><?=$mytarget;?></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Month</span>-->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Attendance</span>
              <div class="count"><?=$attendance_this_month;?></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Month</span>-->
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Data Activities <small>Graph title New Data</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
				  <div class="x_title">
                    <h2>Total Data Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    
				  <?php $today_target_percent=($total_inserted_count_today /$mytarget)*100; ?>
					<div>
                      <p>New Total Data</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: <?=$today_target_percent;?>%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?=$today_target_percent;?>"></div>
                        </div>
                      </div>
                    </div>
					<?php $today_verify_count_percent=($today_verify_count /$mytarget)*100; ?>
                    <div>
                      <p>New Verified Data</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: <?=$today_verify_count_percent;?>%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?=$today_verify_count_percent;?>"></div>
                        </div>
                      </div>
                    </div>
                  </div>
					<?php $total_inserted_count_percent=($total_inserted_count /$mytarget)*100; ?>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Today New Data</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: <?=$total_inserted_count_percent;?>%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?=$total_inserted_count_percent;?>"></div>
                        </div>
                      </div>
                    </div>
					<?php $total_verify_count_percent=($today_verify_count /$mytarget)*100; ?>
                    <div>
                      <p>Today Verified Data</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: <?=$total_verify_count_percent;?>%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?=total_verify_count_percent;?>"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          
         
		  
		  
		  
		  
		  </div>
		  
	<!-- footer content -->
       <?php include('include/footer.php'); ?>
	
	    <script>
		<?php 
		$admin_id=get_admin_id();
		
		
		$day_today=date('d');
	if($day_today>=21)
	{
		$datetime1 = date('y-m-21 00:00:00');
	}
	else
	{
		$datetime1 = date('Y-m-21 00:00:00');
		$datetime1= date('y-m-21 00:00:00',strtotime('-1 month',strtotime($datetime1)));
	}
		
		$now_month=date('m');
		if(isset($_SESSION['performance_month']))
			$now_month=$_SESSION['performance_month'];
		
		$graph_data=array();
		$graph2_data=array();
		for($i=1;$i<=30;$i++)
		{
			$client_id_arr_now=array();
			$client_id_str_now='';
			$now_year=date('Y');
			$date_now=$now_year.'-'.$now_month.'-'.$i;
		$data_entered=sqlfetch("SELECT * FROM new_data_list where admin_id='$admin_id' and dated Like ''");
			$graph_data['Y']=array('Y'=>$now_year,'m'=>$now_month,'d'=>$i,'count'=>count($data_entered));
			
			
			if(count($data_entered))
				foreach($data_entered as $client_data)
				{
					$client_id_arr_now[]=$client_data['cid'];
				}
			
			$client_id_str_now=implode(',',$client_id_arr_now);
			
			$data_verified=sqlfetch("SELECT * FROM customer where id in ('$client_id_str_now') and verify_stat='1'");
			$graph2_data['Y']=array('Y'=>$now_year,'m'=>$now_month,'d'=>$i,'count'=>count($data_verified));
			
		}

		$graph1=array();
		if(is_array($graph_data))
			foreach($graph_data as $graph)
			{ 
			// print_r($graph);
				$graph1[]='[gd('.$graph['Y'].', '.$graph['m'].', '.$graph['d'].'), '.$graph['count'].']';
			}
		$graph1_str=implode(',',$graph1);
		
		$graph2=array();
		if(is_array($graph2_data))
			foreach($graph2_data as $graphs)
			{ 
				$graph2[]='[gd('.$graphs['Y'].', '.$graphs['m'].', '.$graphs['d'].'), '.$graphs['count'].']';
			}
		$graph2_str=implode(',',$graph2);
		?>
		
		
		
		
      $(document).ready(function() {
        var data1 = [
          <?=$graph1_str;?>
        ];

        var data2 = [
          <?=$graph2_str;?>
        ];
        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
          data1, data2
        ], {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 1,
              fill: 0.4
            },
            points: {
              radius: 0,
              show: true
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [1, "day"],
            //tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10
          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: false
        });

        function gd(year, month, day) {
          return new Date(year, month - 1, day).getTime();
        }
      });
    </script>
    <!-- /Flot -->
	<!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 30
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
	
    <!-- JQVMap -->
    <script>
      $(document).ready(function(){
        $('#world-map-gdp').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
        });
      });
    </script>
    <!-- /JQVMap -->

    <!-- Skycons -->
    <script>
      $(document).ready(function() {
        var icons = new Skycons({
            "color": "#73879C"
          }),
          list = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
          ],
          i;

        for (i = list.length; i--;)
          icons.set(list[i], list[i]);

        icons.play();
      });
    </script>
    <!-- /Skycons -->

    

    <!-- gauge.js -->
    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 0.75,
              strokeWidth: 0.042,
              color: '#1D212A'
          },
          limitMax: 'false',
          colorStart: '#1ABC9C',
          colorStop: '#1ABC9C',
          strokeColor: '#F0F3F3',
          generateGradient: true
      };
      var target = document.getElementById('foo'),
          gauge = new Gauge(target).setOptions(opts);

      gauge.maxValue = 6000;
      gauge.animationSpeed = 32;
      gauge.set(3200);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
    <!-- /gauge.js -->