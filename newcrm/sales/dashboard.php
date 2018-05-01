<?php 
$admin_id=get_admin_id();

$total_data_erp=count(total_data_erp(get_admin_id()));
$total_data_erp_left=total_data_erp_left(get_admin_id());

$total_data_erp_mature=total_data_erp_mature(get_admin_id());

$my_target=calculate_my_target(get_admin_id());

$my_attendance_this_month=get_attendance_this_month(get_admin_id());

$total_team_target=$my_target;
$total_team_target_achieved=0;

$my_target_done=calculate_individual_target_done(get_admin_id());
$total_team_target_achieved=$total_team_target_achieved+$my_target_done;
	$data=sqlfetch("SELECT * FROM admin where uplead_id='$now_admin_id' and admin_role_id='2'");
	if(count($data))
	foreach($data as $down_line)
	{
		// $this_target_individual=calculate_individual_target($down_line['id']);
		$this_target_done=calculate_individual_target_done($down_line['id']);
		$total_team_target_achieved=$total_team_target_achieved+$this_target_done;
		// $this_target_percent=($this_target_done/$this_target_individual)*100;
	}


$total_team_target_achieved_percent=($total_team_target_achieved/$total_team_target)*100;

$cust_id_arr=array();
$all_erp_clients=total_data_erp($admin_id);

$all_erp_clients_count=count($all_erp_clients);

if(count($all_erp_clients))
	foreach($all_erp_clients as $all_erp_client)
$cust_id_arr[]=$all_erp_client['cust_id'];

$cust_id_str=implode(',',$cust_id_arr);

//Matured
$total_matured=0;
//Commited
$total_comitted=0;
//Follow Up
$total_followup=0;
//Not Interested
$total_not_interested=0;
//Fresh
$total_fresh=0;


//Matured
$total_matured=count(total_matured_by_me(get_admin_id()));
//Prospective
$total_prospective=count(total_prospective_by_me(get_admin_id()));
//Commited
$total_comitted=count(total_committed_by_me(get_admin_id()));
//Follow Up
$total_followup=count(total_followup_by_me(get_admin_id()));
//Not Interested
$total_not_interested=count(total_data_not_interested_by_me(get_admin_id()));
//Fresh
$total_fresh=count(total_data_fresh_by_me(get_admin_id()));


// $total_fresh=(($all_erp_clients_count)- ($total_matured+$total_comitted+$total_followup+$total_not_interested));

//Matured
$total_matured_percent=$total_matured/$all_erp_clients_count*100;
//Prospective
$total_prospective_percent=$total_prospective/$all_erp_clients_count*100;
//Commited
$total_comitted_percent=$total_comitted/$all_erp_clients_count*100;
//Follow Up
$total_followup_percent=$total_followup/$all_erp_clients_count*100;
//Not Interested
$total_not_interested_percent=$total_not_interested/$all_erp_clients_count*100;
//Fresh
$total_fresh_percent=$total_fresh/$all_erp_clients_count*100;

?>

  <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-table"></i> Total Data</span>
              <div class="count"><?=$total_data_erp;?></div>
              <span class="count_bottom"><i class="orange">100% </i>Data till today</span>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-table"></i> Left Data</span>
              <div class="count"><?=$total_data_erp_left;?></div>
              <span class="count_bottom"><i class="green">
			  <?php $percent = $total_data_erp_left/$total_data_erp;	
				echo $percent_friendly = number_format( $percent * 100, 2 ) . '%';?>
				</i> of Total Data</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Matured Clients</span>
              <div class="count green"><?=$total_data_erp_mature;?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>
			  <?php $percent = $total_data_erp_mature/$total_data_erp;	
				echo $percent_friendly = number_format( $percent * 100, 2 ) . '%';?>
			  </i> From total data</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-inr"></i> Target</span>
              <div class="count"><?=$my_target;?></div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?=number_format($total_team_target_achieved_percent,2);?>% </i> Completed</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-inr"></i> Incentive</span>
              <div class="count"><?=calculate_individual_incentive($admin_id);?></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Month</span>-->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Attendance</span>
              <div class="count"><?=$my_attendance_this_month;?></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Month</span>-->
            </div>
          </div>
          <!-- /top tiles -->

          <br />

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Resource Chart</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>My Team Progress</h4>
                  <?php 
				  $my_target_individual=calculate_individual_target(get_admin_id());
				  $my_target_done=calculate_individual_target_done(get_admin_id());
				  $my_target_percent=($my_target_done/$my_target_individual)*100;
				  
				  ?>
				  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Me</span>
                    </div>
                    <div class="w_center w_55">
						<?=$my_target_percent;?>% Complete
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?=$my_target_percent;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$my_target_percent;?>%;">
                          <span class="sr-only"><?=$my_target_percent;?>% Complete</span>
                        </div>
						
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?=$my_target_individual/100000;?>L</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
<?php //string money_format ( string $format , float $number ); ?>

					<?php
					$data=sqlfetch("SELECT * FROM admin where uplead_id='$now_admin_id' and admin_role_id='2'");
					if(count($data))
					foreach($data as $down_line)
					{
						$this_target_individual=calculate_individual_target($down_line['id']);
						$this_target_done=calculate_individual_target_done($down_line['id']);
						$this_target_percent=($this_target_done/$this_target_individual)*100;
					?>	
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?=get_admin_name_by_id($down_line['id']);?></span>
                    </div>
                    <div class="w_center w_55">
						<?=$this_target_percent;?>% Complete
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?=$this_target_percent;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$this_target_percent;?>%;">
                          <span class="sr-only"><?=$this_target_percent;?>% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?=$this_target_individual/100000;?>L</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
				  <?php
					}
                  ?>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Data Usage</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Status Report</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Data</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p style="text-align:left;" class="">Progress</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Matured </p>
                            </td>
                            <td><?=numbertofloat($total_matured_percent);?>%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square yellow"></i>Prospective</p>
                            </td>
                            <td><?=numbertofloat($total_prospective_percent);?>%</td>
                          </tr>
						  <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Commited</p>
                            </td>
                            <td><?=numbertofloat($total_comitted_percent);?>%</td>
                          </tr>
						  
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Follow Up</p>
                            </td>
                            <td><?=numbertofloat($total_followup_percent);?>%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Fresh</p>
                            </td>
                            <td><?=numbertofloat($total_fresh_percent);?>%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>NI</p>
                            </td>
                            <td><?=numbertofloat($total_not_interested_percent);?>%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Target Meter</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
					
                    <!--<ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>-->

                    <div class="sidebar-widget" style="width:100%;">
                      <h4>Target Completion</h4>
                      <canvas width="150" height="80" id="foo" class="" style="width: 160px; height: 100px;"></canvas>
                      <div class="goal-wrapper">
                        <span class="gauge-value pull-left"><i class="fa fa-inr"></i></span>
                        <span id="gauge-text" class="gauge-value pull-left"><?=$total_team_target_achieved;?></span>
                        <span id="goal-text" class="goal-value pull-right"><i class="fa fa-inr"></i><?=$total_team_target;?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          
		</div>
		  
		  
		  
		  
		  
		  
	<!-- footer content -->
       <?php include('include/footer.php'); ?>
	

    

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas1"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Fresh",
              "Follow Up",
              "Not Interested",
              "Matured",
              "Commited",
              "Prospective"
            ],
            datasets: [{
              data: [<?=$total_fresh;?>, <?=$total_followup;?>, <?=$total_not_interested;?>,<?=$total_matured;?>, <?=$total_comitted;?>, <?=$total_prospective;?>],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB",
				"#EFEC2A"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA",
				"#F8FE23"
              ]
            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->
    
    <!-- gauge.js -->
    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 1.5,
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

      gauge.maxValue = <?=$total_team_target;?>;
      gauge.animationSpeed = 32;
      gauge.set(<?=$total_team_target_achieved;?>);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
    <!-- /gauge.js -->