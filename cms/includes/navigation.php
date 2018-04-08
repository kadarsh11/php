<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php 
                    $query_navigation_title="SELECT * FROM categories";
                    $data_navigation_title=mysqli_query($connection,$query_navigation_title)or die(mysqli_error());
                    while ($row_navigation_title=mysqli_fetch_array($data_navigation_title)) {
                        ?>
                    <li>
                        <a href="#"><?php echo $row_navigation_title['cat_title']; ?></a>
                    </li>    
                        <?php
                    }
                     ?>     
                       <li>
                        <a href="admin">Admin</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>