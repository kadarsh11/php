<?php include('function/function.php');
check_session();
?>
<?php include('include/header.php');?>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <?php include('include/sidebar.php'); ?>
        
		</div>

        <!-- top navigation -->
        <?php include('include/top.php'); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
			<?php 
				  if(get_admin_role_id(get_admin_id())=='1')
				  { 
					include('manager/dashboard.php');
				  }
				  elseif(get_admin_role_id(get_admin_id())=='2')
				  { 
					include('sales/dashboard.php');
			  
				  }
				  elseif(get_admin_role_id(get_admin_id())=='5')
				  { 
					include('data_operator/dashboard.php');
			  
				  }
				  elseif(get_admin_role_id(get_admin_id())=='6')
				  { 
					include('verifier/dashboard.php');
			  
				  }
				  else
				  {
					include('dashboard.php');  
				  }
			  ?>
			  
			
		</div>
        <!-- /page content -->

        
	   
	      <!-- Flot -->


