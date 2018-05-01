	<div class="">
				<div class="page-title">
				  <div class="title_left">
					<h3>Fresh Party <small></small></h3>
				  </div>
					<!--
				  <div class="title_right">
					<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					  <div class="input-group">
						<input class="form-control" placeholder="Search for..." type="text">
						<span class="input-group-btn">
						  <button class="btn btn-default" type="button">Go!</button>
						</span>
					  </div>
					</div>
				  </div>
				  -->
				</div>
				<div class="row" >
					<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Today <small>Clients</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      
                    </p>
					
					<form action="" method="post" >
						<div class="form-group">
							<label class="control-label col-md-1 col-sm-1 col-xs-12">Forward to Sales</label>
							<span class="col-md-3">
								<select class="form-control" name="sales_member">
									<option>SELECT Sales Member</option>
									<?php 
									$admin_id=get_admin_id();
									$sales_team_data=sqlfetch("SELECT * FROM admin where admin_role_id='2' and uplead_id='$admin_id' order by position ");
									if(count($sales_team_data))
										foreach($sales_team_data as $sales_team)
										{ ?>
											<option value="<?=$sales_team['id'];?>"><?=$sales_team['fname'];?></option>
											<?php
										}
									
									?>
								</select>
							</span>
							<span class="col-md-2">
								<button class="btn btn-warning" value="true" name="forward_to_sales">Forward</button>
							</span>
							<span class="col-md-2 pull-right">
								<button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
							</span>
						</div>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th><input type="checkbox" id="check-all" class="flat"></th>
                          <th>Company Name</th>
                          <th>Category</th>
                          <th>Next Follow up Time</th>
                          <th>Call Now</th>
                        </tr>
                      </thead>
					  <tbody>
					  
					  <?php 
					  $admin_id=get_admin_id();
					  $client_data=today_data_fresh_by_me($admin_id);
					  if(count($client_data))
						  foreach($client_data as $client)
						  {
					  ?>
						<tr>
							<td><input type="checkbox" value="<?=$customer['id'];?>" class="flat" name="table_records[]"></td>
							<td><?=$client['c_name'];?></td>
							<td><?=get_customer_category($client['fld_category_id']);?></td>
							<td><?=get_customer_next_follow_date($client['id']);?></td>
							<td><a href="saleoncall.php?cid=<?=$client['id']; ?>"><i class="fa fa-phone"></i></a></td>
						</tr>
						<?php
						  }
						  ?>
					  </tbody>
					</table>
                  </div>
                </div>
              </div>
					
				</div>
			</div>	