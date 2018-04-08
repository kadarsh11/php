    <?php include './includes/connection.php'; ?>
    <?php include './includes/header.php'; ?>
    

    <!-- Navigation -->
    <?php include './includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->

                <?php 
                $post_query="SELECT * FROM post";
                $data_post=mysqli_query($connection,$post_query);
                while ($row_post=mysqli_fetch_array($data_post)) {
                    ?>
                     <h2>
                    <a href="#"><?php echo $row_post['post_title']; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row_post['post_author']; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row_post['post_date']; ?></p>
                <hr>
                <img class="img-responsive" src="./images/<?php echo $row_post['post_image'];?>" alt="">
                <hr>
                <p><?php echo $row_post['post_content']; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                    <?php
                }
                 ?>

                <!-- Pager -->
              <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include './includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      <?php include './includes/footer.php'; ?>