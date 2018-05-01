		<div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?=SITE_URL; ?>" class="site_title"><i class="fa fa-paw"></i> <span><?=COPYRIGHT_NAME; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?=get_admin_photo_by_admin_id(get_admin_id());?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome <br><?=get_admin_name_by_id(get_admin_id());?></span>
                <br /><br />
              </div>
            </div>
            <!-- /menu profile quick info -->

			<br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3><?=get_admin_role_text_by_admin_id(get_admin_id());?></h3>
                <ul class="nav side-menu">
                  <?php 
				  if(get_admin_role_id(get_admin_id())=='2')
				  { 
			  
			  $today_matured=count(today_matured_by_me(get_admin_id()));
			  $total_matured=count(total_matured_by_me(get_admin_id()));
			  
			  $today_prospective=count(today_prospective_by_me(get_admin_id()));
			  $total_prospective=count(total_prospective_by_me(get_admin_id()));
			  
			  $today_committed=count(today_committed_by_me(get_admin_id()));
			  $total_committed=count(total_committed_by_me(get_admin_id()));
			  
			  $today_followup=count(today_followup_by_me(get_admin_id()));
			  $total_followup=count(total_followup_by_me(get_admin_id()));
			  
			  $today_fresh=count(today_data_fresh_by_me(get_admin_id()));
			  $total_fresh=count(total_data_fresh_by_me(get_admin_id()));
			  
			  ?>
				  <li><a><i class="fa fa-user"></i> Matured<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="sales_party.php?option=matured&page=today">Today(<?=$today_matured;?>)</a></li>
                      <li><a href="sales_party.php?option=matured&page=total">Total(<?=$total_matured;?>)</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-user"></i>Prospective<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="sales_party.php?option=prospective&page=today">Today(<?=$today_prospective;?>)</a></li>
                      <li><a href="sales_party.php?option=prospective&page=total">Total(<?=$total_prospective;?>)</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-user"></i> Committed <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="sales_party.php?option=committed&page=today">Today(<?=$today_committed;?>)</a></li>
                      <li><a href="sales_party.php?option=committed&page=total">Total(<?=$total_committed;?>)</a></li>
                    </ul>
                  </li>
				  
				  <li><a><i class="fa fa-user"></i> Follow Up <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="sales_party.php?option=followup&page=today">Today(<?=$today_followup;?>)</a></li>
                      <li><a href="sales_party.php?option=followup&page=total">Total(<?=$total_followup;?>)</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-user"></i> Fresh <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="sales_party.php?option=fresh&page=today">Today(<?=$today_fresh;?>)</a></li>
                      <li><a href="sales_party.php?option=fresh&page=total">Total(<?=$total_fresh;?>)</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-user"></i> Not Interested </a></li>
					<?php
					if(
					(in_array('13',$get_admin_access_arr)) or 
					(in_array('14',$get_admin_access_arr)) or 
					(in_array('15',$get_admin_access_arr)) or 
					(in_array('16',$get_admin_access_arr)) or 
					
					(in_array('57',$get_admin_access_arr)) or 
					(in_array('58',$get_admin_access_arr)) or 
					(in_array('59',$get_admin_access_arr)) or 
					(in_array('60',$get_admin_access_arr)) or 
					
					(in_array('17',$get_admin_access_arr)) or 
					(in_array('18',$get_admin_access_arr)) or 
					(in_array('19',$get_admin_access_arr)) or 
					(in_array('20',$get_admin_access_arr))
					){
					?>
				  <li><a><i class="fa fa-user"></i> Clients <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('17',$get_admin_access_arr))){ ?>
					  <li><a href="add_customer.php">Add New</a></li><?php } ?>
                      <?php if((in_array('20',$get_admin_access_arr))){ ?>
                      <li><a href="view_customer.php">View Clients</a></li><?php } ?>
                      <?php if((in_array('13',$get_admin_access_arr))){ ?>
                      <li><a href="add_cgroup.php">Add Client Groups</a></li><?php } ?>
                      <?php if((in_array('16',$get_admin_access_arr))){ ?>
                      <li><a href="view_cgroup.php">View Client Groups</a></li><?php } ?>
                      <?php if(get_admin_id()==2){ ?>
                      <li><a href="view_customer_new_verified.php">Verified Client List</a></li><?php } ?>
                    </ul>
                  </li>
				  <?php 
					}
				  ?>
					
					<?
				  }
				  else
				  { 
				  if(get_admin_role_id(get_admin_id())=='1')
				  {  ?>
				  <li><a><i class="fa fa-table"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					  <li><a href="sales_reports.php">Sales</a></li>
                    </ul>
                  </li>
					<?
				  }
				
					if(
					(in_array('13',$get_admin_access_arr)) or 
					(in_array('14',$get_admin_access_arr)) or 
					(in_array('15',$get_admin_access_arr)) or 
					(in_array('16',$get_admin_access_arr)) or 
					
					(in_array('57',$get_admin_access_arr)) or 
					(in_array('58',$get_admin_access_arr)) or 
					(in_array('59',$get_admin_access_arr)) or 
					(in_array('60',$get_admin_access_arr)) or 
					
					(in_array('17',$get_admin_access_arr)) or 
					(in_array('18',$get_admin_access_arr)) or 
					(in_array('19',$get_admin_access_arr)) or 
					(in_array('20',$get_admin_access_arr))
					){
					?>
				  <li><a><i class="fa fa-user"></i> Clients <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('17',$get_admin_access_arr))){ ?>
					  <li><a href="add_customer.php">Add New</a></li><?php } ?>
                      <?php if((in_array('20',$get_admin_access_arr))){ ?>
                      <li><a href="view_customer.php">View Clients</a></li><?php } ?>
                      <?php if((in_array('13',$get_admin_access_arr))){ ?>
                      <li><a href="add_cgroup.php">Add Client Groups</a></li><?php } ?>
                      <?php if((in_array('16',$get_admin_access_arr))){ ?>
                      <li><a href="view_cgroup.php">View Client Groups</a></li><?php } ?>
                      <?php if(get_admin_id()==2){ ?>
                      <li><a href="view_customer_new_verified.php">Verified Client List</a></li><?php } ?>
                    </ul>
                  </li>
				  <?php 
					}
				  ?>
				  <?php
					if(
					(in_array('1',$get_admin_access_arr)) or 
					(in_array('2',$get_admin_access_arr)) or 
					(in_array('3',$get_admin_access_arr)) or 
					(in_array('4',$get_admin_access_arr))
					){
					?>
                  <li><a><i class="fa fa-user"></i>Employees<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('1',$get_admin_access_arr))){ ?>
                      <li><a href="add_admin.php">Add Employee</a></li><?php } ?>
                      <?php if((in_array('4',$get_admin_access_arr))){ ?>
                      <li><a href="view_admin.php">View Employee</a></li><?php } ?>
                    </ul>
                  </li>
				  <?php
					}
					?>
					<?php 
					if(
					(in_array('5',$get_admin_access_arr)) or 
					(in_array('6',$get_admin_access_arr)) or 
					(in_array('7',$get_admin_access_arr)) or 
					(in_array('8',$get_admin_access_arr))
					){
					?>
                  <li><a><i class="fa fa-key"></i>Admin Roles<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('5',$get_admin_access_arr))){ ?>
                      <li><a href="add_admin_roles.php">Add New</a></li><?php } ?>
                      <?php if((in_array('8',$get_admin_access_arr))){ ?>
                      <li><a href="view_admin_roles.php">View Roles</a></li><?php } ?>
                    </ul>
                  </li>
					<?php 
					}
					?>
					<?php 
					if(
					(in_array('45',$get_admin_access_arr)) or 
					(in_array('46',$get_admin_access_arr)) or 
					(in_array('47',$get_admin_access_arr)) or 
					(in_array('48',$get_admin_access_arr)) or
					(in_array('61',$get_admin_access_arr)) or 
					(in_array('62',$get_admin_access_arr)) or 
					(in_array('63',$get_admin_access_arr)) or 
					(in_array('64',$get_admin_access_arr))
					){
					?>
                  <li><a><i class="fa fa-crosshairs"></i>Targets<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('45',$get_admin_access_arr))){ ?>
                      <li><a href="add_sale_target.php">Add Sales Targets</a></li><?php } ?>
                      <?php if((in_array('48',$get_admin_access_arr))){ ?>
                      <li><a href="view_sale_target.php">View Sales Targets</a></li><?php } ?>
					  <?php if((in_array('61',$get_admin_access_arr))){ ?>
                      <li><a href="add_data_target.php">Add Data Targets</a></li><?php } ?>
                      <?php if((in_array('64',$get_admin_access_arr))){ ?>
                      <li><a href="view_data_target.php">View Data Targets</a></li><?php } ?>
                    </ul>
                  </li>
					<?php 
					}
					?>
					<?php 
					if(
					(in_array('25',$get_admin_access_arr)) or 
					(in_array('26',$get_admin_access_arr)) or 
					(in_array('27',$get_admin_access_arr)) or 
					(in_array('28',$get_admin_access_arr))
					){
					?>
                  <li><a><i class="fa fa-life-saver"></i>Incentives<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('25',$get_admin_access_arr))){ ?>
                      <li><a href="add_incentive.php">Add Incentives</a></li><?php } ?>
                      <?php if((in_array('28',$get_admin_access_arr))){ ?>
                      <li><a href="view_incentive.php">View Incentives</a></li><?php } ?>
                    </ul>
                  </li>
					<?php 
					}
					?>
					<?php 
					if(
					(in_array('49',$get_admin_access_arr)) or 
					(in_array('50',$get_admin_access_arr)) or 
					(in_array('51',$get_admin_access_arr)) or 
					(in_array('52',$get_admin_access_arr))
					){
					?>
                  <li><a><i class="fa fa-gear"></i>Services<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('49',$get_admin_access_arr))){ ?>
                      <li><a href="add_services.php">Add Services</a></li><?php } ?>
                      <?php if((in_array('52',$get_admin_access_arr))){ ?>
                      <li><a href="view_services.php">View Services</a></li><?php } ?>
                    </ul>
                  </li>
				  <?php 
					}
					?>
					<?php 
					if(
					(in_array('29',$get_admin_access_arr)) or 
					(in_array('30',$get_admin_access_arr)) or 
					(in_array('31',$get_admin_access_arr)) or 
					(in_array('32',$get_admin_access_arr))
					){
					?>
                  <li><a><i class="fa fa-sliders"></i>Packages<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('29',$get_admin_access_arr))){ ?>
					  <li><a href="add_package.php">Add Package</a></li><?php } ?>
                      <?php if((in_array('32',$get_admin_access_arr))){ ?>
                      <li><a href="view_package.php">View Package</a></li><?php } ?>
                    </ul>
                  </li>
				  <?php 
					}
					?>
					<?php 
					if(
					(in_array('41',$get_admin_access_arr)) or 
					(in_array('42',$get_admin_access_arr)) or 
					(in_array('43',$get_admin_access_arr)) or 
					(in_array('44',$get_admin_access_arr))
					){
					?>
                  <li><a><i class="fa fa-money"></i>Verify Payments<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('41',$get_admin_access_arr))){ ?>
                      <li><a href="add_sale_done.php">Add Sale</a></li><?php } ?>
                      <?php if((in_array('44',$get_admin_access_arr))){ ?>
                      <li><a href="view_sale_done.php">View Sales</a></li><?php } ?>
                    </ul>
                  </li>
                  <?php 
					}
					?>
					<?php 
					if(
					(in_array('65',$get_admin_access_arr)) or 
					(in_array('66',$get_admin_access_arr)) or 
					(in_array('67',$get_admin_access_arr)) or 
					(in_array('68',$get_admin_access_arr))
					){
					?>
                  <li><a><i class="fa fa-map-marker"></i>Cities<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if((in_array('65',$get_admin_access_arr))){ ?>
                      <li><a href="add_sale_done.php">Add Cities</a></li><?php } ?>
                      <?php if((in_array('68',$get_admin_access_arr))){ ?>
                      <li><a href="view_sale_done.php">View Cities</a></li><?php } ?>
                    </ul>
                  </li>
                  <?php 
					}
					?>
				  <?php 
				  }
				  ?>
                </ul>
              </div>
              
			 
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        
