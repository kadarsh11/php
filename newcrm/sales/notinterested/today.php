	<div class="">
				<div class="page-title">
				  <div class="title_left">
					<h3>Not Interested Party <small></small></h3>
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
                    <h2>Today<small>Clients</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Company Name</th>
                          <th>Category</th>
                          <th>Next Follow up Time</th>
                          <th>Call Now</th>
                        </tr>
                      </thead>
					  <tbody>
					  
					  <?php 
					  $admin_id=get_admin_id();
					  $erp_arr=array();
					  $client_id_arr=array();
					  
					  $erp_data=sqlfetch("SELECT cid,assign_to FROM sales_data_assign where assign_to='$admin_id'");
					  if(count($erp_data))
						  foreach($erp_data as $erp_ids)
						  {
							$erp_arr[]=$erp_ids['cid'];
						  }
						  
						  $erp_id_str=implode(',',$erp_arr);
					  
					  $status_id=5;
					  
					  $erp_chat_data=sqlfetch("SELECT * FROM erp_chat where cid in ('$erp_id_str') and status='$status_id' ");
						if(count($erp_chat_data))
							foreach($erp_chat_data as $erp_chat)
							{
								$client_id_arr[]=$erp_chat['cid'];
							}
						$client_id_str=implode(',',$client_id_arr);
						
					  $client_data=sqlfetch("SELECT * FROM customer where id in ('$client_id_str') and actstat='0' and verify_stat='1'"); 
					  if(count($client_data))
						  foreach($client_data as $client)
						  {
					  ?>
						<tr>
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