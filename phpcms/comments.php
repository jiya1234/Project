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

     <div style="height:10px; background: #27aae1;"></div>
            <nav class="navbar navbar-inverse" role="navigation">
                
                 <div  class="container">
                     <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                         <span class="sr-only">Toggle Navigation</span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                         </button>
                         <div class="collapse navbar-collapse" id="collapse">
                     <ul class="nav navbar-nav">
                         <li><a href="#">Home</a></li>
                         <li class="active"><a href="blog.php" target="_blank">Blog</a></li>
                         <li><a href="#">About Us</a></li>
                         <li><a href="#">Services</a></li>
                         <li><a href="#">Contact Us</a></li>
                         <li><a href="#">Feature</a></li>
                         </ul>
                         <form action="blog.php" class="navbar-form navbar-right">
                         <div class="form-group">
                             <input type="text" class="form-control" placeholder="SEARCH" name="Search">
                             </div>
                             <button class="btn btn-default" name="SearchButton">Go</button>
                             
                         </form>
                             </div>
                     </div>
                
                     </div> </nav>
            <div style="margin-top: -20px; height:10px; background: #27aae1;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <br>
                <br>
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                    <li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>Dashboard</a></li>
                    <li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>Add New Post</a></li>
                    <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>Categories</a></li>
                    <li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>Manage Admins</a></li>
                    <li class="active"><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>$nbps;Comments
                        
                        </a></li>
                    <li><a href="blog.php"><span class="glyphicon glyphicon-equalizer"></span>Live Blog</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                </ul>
            </div>
            <!-- Ending of side area-->
            <div class="col-sm-10">
             <div>
            <div><?php echo ErrorMessage();?>
                <div><?php echo SuccessMessage();?>
                </div>
                <h1>Un-Approved Comments</h1>
               <div class="table-responsive">
                 <table class="table table-stripped table-hover">
                   <tr>
                     <th>No.</th>
                       <th>Name</th>
                       <th>Date</th>
                       <th>Comment</th>
                       <th>Approve</th>
                       <th>Delete Comment</th>
                       <th>Details</th>
                     </tr>
                     <?php
                     $ConnectingDB;
                     $Query="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc";
                     $Execute=mysql_query($Query);
                     $SrNo=0;
                     while($DataRows=mysql_fetch_array($Execute)){
                         $CommentId=$DataRows['id'];
                         $DateTimeofComment=$DataRows['datetime'];
                         $PersonName=$DataRows['name'];
                         $PersonComment=$DataRows['comment'];
                         $CommentedPostId=$DataRows['admin_panel_id'];
                         $SrNo++;
                         //if(strlen($PersonComment)>18){$PersonComment=substr($PersonComment,0,18).'..';}
                         if(strlen($PersonName)>10){$PersonName=substr($PersonName,0,10).'..';}
                     
                     ?>
                     <tr>
                          <td>
                         <?php echo $SrNo;?>
                         </td>
                     <td>
                         <?php echo $PersonName; ?>
                         </td>
                          <td>
                         <?php echo $DateTimeofComment;?>
                         </td>
                          <td>
                         <?php echo $PersonComment;?>
                         </td>
                          <td>
                         <a href="approvecomments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a>
                         </td>
                          <td>
                        <a href="deletecomments.php?id=<?php echo $CommentId;?>"><span class="btn btn-danger">Delete</span></a>
                         </td>
                         <td>
                        <a href="fullpost.php?id=<?php echo $CommentedPostId;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>
         </td>
                     </tr>
                     <?php } ?>
                   </table></div>
                  <h1>Approved Comments</h1>
               <div class="table-responsive">
                 <table class="table table-stripped table-hover">
                   <tr>
                     <th>No.</th>
                       <th>Name</th>
                       <th>Date</th>
                       <th>Comment</th>
                       <th>Approved By</th>
                       <th>Dis-Approve</th>
                       <th>Delete Comment</th>
                       <th>Details</th>
                     </tr>
                     <?php
                     $ConnectingDB;
                     $Query="SELECT * FROM comments WHERE status='ON' ORDER BY datetime desc";
                     $Execute=mysql_query($Query);
                     $SrNo=0;
                     while($DataRows=mysql_fetch_array($Execute)){
                         $CommentId=$DataRows['id'];
                         $DateTimeofComment=$DataRows['datetime'];
                         $PersonName=$DataRows['name'];
                         $PersonComment=$DataRows['comment'];
                         $ApprovedBy=$DataRows['approvedby'];
                         $CommentedPostId=$DataRows['admin_panel_id'];
                         $SrNo++;
                        // {$PersonComment=substr($PersonComment,0,18).'..';} 
                         if(strlen($PersonName)>10){$PersonName=substr($PersonName,0,10).'..';}
                     
                     ?>
                     <tr>
                          <td>
                         <?php echo $SrNo;?>
                         </td>
                     <td>
                         <?php echo $PersonName; ?>
                         </td>
                          <td>
                         <?php echo $DateTimeofComment;?>
                         </td>
      <td>
                         <?php echo $PersonComment;?>
                         </td>
                          <td>
                         <?php echo $ApprovedBy;?>
                         </td>
                          <td>
                         <a href="disapprove.php?id=<?php echo $CommentId;?>"><span class="btn btn-success">Dis-Approve</span></a>
                         </td>
                          <td>
                        <a href="deletecomments.php?id=<?php echo $CommentId;?>"><span class="btn btn-danger">Delete</span></a>
                         </td>
                         <td>
                        <a href="fullpost.php?id=<?php echo $CommentedPostId;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>
                         </td>
                     </tr>
                     <?php } ?>
                   </table></div>
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
