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
        <div class="right_col" role="main">        <!-- page content -->
		<div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">403</h1>
              <h2>Access denied</h2>
              <p>Full authentication is required to access this resource. 
              </p>
              <div class="mid_center">
                <a href="<?=SITE_URL;?>"><h3>Go Back to Home</h3></a>
                
              </div>
            </div>
          </div>
        </div>
		</div>
		<?php include('include/footer.php');?>