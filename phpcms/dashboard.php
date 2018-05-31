<?php require_once("include/session.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php Confirm_Login(); ?>
<!DOCTYPE>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/adminstyles.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
</head>

<body>

    -
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <br>
                <br>
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                    <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>Dashboard</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span>Add New Post</a></li>
                    <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>Categories</a></li>
                    <li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>Manage Admins</a></li>
                    <li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>Comments
                         <?php
                            $ConnectingDB;
                            $QueryTotal="SELECT COUNT(*) FROM comments WHERE status='OFF'";
                            $ExecuteTotal=mysql_query($QueryTotal);
                            $RowsTotal=mysql_fetch_array($ExecuteTotal);
                            $Total=array_shift($RowsTotal);
                            if($Total>0){
                                ?>
                            <span class="label pull-right label-warning">
                                <?php echo $Total; ?>
                                </span>
                            <?php } ?> 
                        
                        </a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>Live Blog</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                </ul>
            </div>
            <!-- Ending of side area-->
            <div class="col-sm-10">
             <div>
            <div><?php echo SuccessMessage();?>
                </div>
                 <div><?php echo ErrorMessage();?>
                </div>
                <h1>Admin Dashboard</h1>
                <div class="table-responsive">
                    <table class="table table-stripped table-hover">
                        <tr>

                            <th>No</th>
                            <th>Post Title</th>
                            <th>Date and Time</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Details</th>

                        </tr>
                        <?php 
                        $ConnectingDB;
                        $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc";
                        $Execute=mysql_query($ViewQuery);
                        $SrNo=0;
                        while($DataRows=mysql_fetch_array($Execute)){
                        $Id=$DataRows['id'];
                        $DateTime=$DataRows['datetime'];    
                            $Title=$DataRows['title'];
                            $Category=$DataRows['category'];
                            $Admin=$DataRows['author'];
                            $Image=$DataRows['image'];
                            $Post=$DataRows['post'];
                            $SrNo++;
                        ?>
                        <tr>
                        <td><?php echo $SrNo; ?></td>
                            <td style="color:#5e5eff;"><?php 
                            if(strlen($Title)>20){
                                $Title=substr($Title,0,20)."..";
                            }
                            echo $Title; ?></td>
                            <td><?php
                            if(strlen($DateTime)>11){
                                $DateTime=substr($DateTime,0,11);
                            }
                            echo $DateTime; ?></td>
                            <td><?php
                            
                            if(strlen($Admin)>6){
                                $Admin=substr($Admin,0,6);
                            }
                            echo $Admin; ?></td>
                            <td><?php
                             
                            if(strlen($Category)>8){
                                $Category=substr($Category,0,8);
                            }
                            echo $Category; ?></td>
                            <td><img src="upload/<?php echo $Image; ?>" width="170px"; height="50px"></td>
                            <td>
                            <?php
                            $ConnectingDB;
                            $QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
                            $ExecuteApproved=mysql_query($QueryApproved);
                            $RowsApproved=mysql_fetch_array($ExecuteApproved);
                            $TotalApproved=array_shift($RowsApproved);
                            if($TotalApproved>0){
                                ?>
                            <span class="label pull-right label-success">
                                <?php echo $TotalApproved; ?>
                                </span>
                            <?php } ?>
                             <?php
                            $ConnectingDB;
                            $QueryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
                            $ExecuteUnApproved=mysql_query($QueryUnApproved);
                            $RowsUnApproved=mysql_fetch_array($ExecuteUnApproved);
                            $TotalUnApproved=array_shift($RowsUnApproved);
                            if($TotalUnApproved>0){
                                ?>
                            <span class="label  label-danger">
                                <?php echo $TotalUnApproved; ?>
                                </span>
                            <?php } ?>    
                            
                            </td>
                            <td><a href="editpost.php?Edit=<?php echo $Id;?>"><span class="btn btn-warning">Edit</span></a>
                                
                            <a href="deletepost.php?Delete=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a></td>
                            <td><a href="fullpost.php?id=<?php echo $Id;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
                        </tr>
                       <?php } ?>
                    </table>
                </div>
            </div>
            <!-- ending of maian area-->
        </div>
        <!--Ending of row-->
    </div>
    <!--Ending of container-->
    <div id="Footer">
        <hr>
        <p>Theme By| Javeria Gauhar | &copy;2016-2020 ---All Right Reserved.</p>
        <a style="color:white; text-decoration:none; cursor:pointer; font-weight:bold;" href="#"></a>

    </div>

    <div style="height:10px; background-color:27AAE1;"></div>
    </div>
</body>

</html>
